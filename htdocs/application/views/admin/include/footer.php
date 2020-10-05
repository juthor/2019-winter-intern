</div>

<!-- MODAL > 주소검색 -->
<div class="modal fade" id="modal-searchAddr">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">주소 검색</h4>
            </div>

            <div class="modal-body">
                <small>도로명주소 또는 지번주소를 번지까지 상세히 입력해주세요.</small>
                <div class="input-group">
                    <input type="text" name="searchAddr_keyword" class="form-control" placeholder="주소를 입력해주세요">
                    <span class="input-group-btn">
                    <a href="javascript:searchAddr()" class="btn btn-default" type="button"><span class="fa fa-search"></span></a>
                </span>
                </div>

                <div id="input-alert-loading-search-addr" class="input-alert hide">
                    <span class="fa fa-spinner fa-spin"></span>
                    <p>로딩중</p>
                </div>

                <div id="input-alert-too-many-result" class="input-alert hide">
                    <span class="fa fa-exclamation-triangle"></span>
                    <p>검색결과가 너무 많습니다</p>
                    <small>번지 등을 포함한 자세한 주소로 다시 검색하세요</small>
                </div>

                <ul id="searchAddr-result" class="list-group"></ul>

                <!-- 더보기 버튼 -->
                <div class="text-center">
                    <a href="#" class="btn btn-default hide" id="btn-view-more-addr">주소 더 보기</a>
                </div>
            </div>

            <div class="modal-footer">
                <a class="btn" data-dismiss="modal">닫기</a>
            </div>
        </div>
    </div>
</div>


<script>
    $(function(){
        // 현재시간 표시
        display_cur_time();
        setInterval(function(){
            display_cur_time();
        },1000);

        $('.rachel').rachel();
        $('.selectpicker').selectpicker();

        // 주소모달
        $('input[name="searchAddr_keyword"]').keypress(function(e) { if (e.keyCode == 13) searchAddr(); });
    });

    function display_cur_time(){
        $('#body-bar>.cur-time>small').text(moment().format('YYYY MMMM Do dddd'));
        $('#body-bar>.cur-time>span').text(moment().format('a h:mm:ss'));
    }

    //주소검색
    function open_searchAddr(){
        $('#modal-searchAddr').modal();
        $('#modal-searchAddr').on('shown.bs.modal', function (e) {
            $('input[name="searchAddr_keyword"]').focus();
        });
    }

    var searchAddr_curPage = 0;
    var searchAddr_perPage = 20;

    function searchAddr(currentPage,isAppendList){
        // 초기화
        if(!isAppendList){
            $('#searchAddr-result').html('');
            $('#modal-searchAddr').scrollTop(0);
        }

        $('.input-alert').addClass('hide');
        $('#btn-view-more-addr').addClass('hide');

        //유효성 검사
        var keyword = $('input[name="searchAddr_keyword"]');
        if(keyword.val()==""){
            alert('검색하실 주소를 입력해주세요');
            keyword.focus();
            return;
        }

        // 검색 전송
        keywordValue = encodeURIComponent(keyword.val());
        var currentPage = currentPage;
        if(currentPage=='' || currentPage==undefined) currentPage = 1;
        var url = 'http://openapi.epost.go.kr/postal/retrieveNewAdressAreaCdSearchAllService/retrieveNewAdressAreaCdSearchAllService/getNewAddressListAreaCdSearchAll?ServiceKey=meytJ20PuqUbiqT8uefUyf1DYcvEnYvU7kXgVPZHs4el1arGmU%2FC1QAEfRvKpdtwy9lBPNnRO6GCK%2BCwso%2FzNw%3D%3D&countPerPage='+searchAddr_perPage+'&currentPage='+currentPage+'&srchwrd='+keywordValue;

        console.log(url);
        $.ajax({
            type: "POST",
            data: {url: url},
            url: "<?=base_url()?>index/fp",
            beforeSend:function(){
                console.log('beforesend');
                $('#input-alert-loading-search-addr').removeClass('hide');
            },
            success: function (xml){
                console.log('suc');
                //$('#pagination-searchAddr>li').removeClass('active');
                searchAddrResult(xml,currentPage);
            },
            error: function () {
                alert('주소검색 에러가 발생하였습니다. (1)');
            }
        });
        console.log('dd');
    }

    function searchAddrResult(xml,currentPage){
        $.ajax({
            type: "POST",
            data: {result:xml},
            url: '<?=base_url()?>index/searchAddrResult',
            success: function(result){
                console.log(result);
                $('#input-alert-loading-search-addr').addClass('hide');

                var res = $.parseJSON(result);
                console.log(res);

                if(Number(res.total[0])>20) $('#input-alert-too-many-result').removeClass('hide');

                searchAddr_curPage = currentPage;

                // addr List
                var append = '';
                $.each(res.addrList,function(r){ //res.addrList[r].lnm
                    if(res.addrList[r].postcode){
                        append += '<li class="list-group-item"><a href="javascript:selectSearchAddr(\''+res.addrList[r].postcode+'\',\''+res.addrList[r].lnm+'\',\''+res.addrList[r].rn+'\')">';
                        append += '<p><span class="label">우편번호</span> '+res.addrList[r].postcode+'</p>';
                        append += '<p><span class="label">신 주소</span> '+res.addrList[r].lnm+'</p>';
                        append += '<p><span class="label">구 주소</span> '+res.addrList[r].rn+'</p>';
                        append += '</a></li>';
                    }
                });
                $('#searchAddr-result').append(append);

                // 더보기 버튼
                var btn_more = $('#btn-view-more-addr');
                if(res.total[0]>searchAddr_perPage*currentPage){
                    btn_more.removeClass('hide');
                    btn_more.attr('href','javascript:searchAddr('+(Number(searchAddr_curPage)+1)+',\'true\')');
                }else{
                    btn_more.addClass('hide');
                }

            },
            error: function(result){
                alert('주소검색 에러가 발생하였습니다. (2)');
            }
        });
    }

    function selectSearchAddr(postcode,addr,rn){
        //입력
        $('input[name="addr1"]').val(addr);
        $('input[name="addr2"]').focus();
        $('input[name="addr1_old"]').val(rn);

        //초기화
        $('input[name="searchAddr_keyword"]').val('');
        $('#modal-searchAddr').find('#searchAddr-result').html('');
        $('#modal-searchAddr').modal('hide');

        // 좌표 구하기
        naver.maps.Service.geocode({
            address: addr
        }, function(status, response) {
            if (status === naver.maps.Service.Status.ERROR) {
                return alert('Something Wrong!');
            }

            var item = response.result.items[0],
                point = new naver.maps.Point(item.point.x, item.point.y);

            $('input[name="lat"]').val(point.x);
            $('input[name="lng"]').val(point.y);
        });

        // 다음 함수
        if (typeof afterSelectAddr === 'function') {
            afterSelectAddr();
        }
    }

    function convert_phone(num){
        num = num.replace(/[^0-9]/g, '');
        var prefix_tel = ['02','031','032','033','041','042','043','044','051','052','053','054','055','061','062','063','064','070','080'];
        var prefix_phone = ['010','011','016','017','018','019'];
        var prefix_gen = ['1544','1588','1644','1661','1800','1833','1668','1666','1688','1599','1800','1811','1877','1855','1522','1811'];

        var phone1 = "";
        var phone1_remain = "";
        var phone2 = "";
        var phone3 = "";

        var type = "";
        if(num.substr(0,2)=='02'){
            type = "tel";
            phone1 = "02";
            phone1_remain = num.substr(2);
        }else if($.inArray(num.substr(0,3),prefix_tel)>-1){
            type = "tel";
            phone1 = num.substr(0,3);
            phone1_remain = num.substr(3);
        }else if($.inArray(num.substr(0,3),prefix_phone)>-1){
            type = "phone";
            phone1 = num.substr(0,3);
            phone1_remain = num.substr(3);
        }else if($.inArray(num.substr(0,4),prefix_gen)>-1){
            type = "gen";
            phone1 = num.substr(0,4);
            phone1_remain = num.substr(4,4);
        }

        switch(type){
            case 'tel':
                if(phone1_remain.length==7){
                    phone2 = phone1_remain.substr(0,3);
                    phone3 = phone1_remain.substr(3,4);
                }else{
                    phone2 = phone1_remain.substr(0,4);
                    phone3 = phone1_remain.substr(4,4);
                }
                break;

            case 'phone':
                if(phone1_remain.length==7){
                    phone2 =phone1_remain.substr(0,3);
                    phone3 =phone1_remain.substr(3,4);
                }else{
                    phone2 =phone1_remain.substr(0,4);
                    phone3 =phone1_remain.substr(4,4);
                }
                break;

            case 'gen':
                phone2 = phone1_remain;
                break;

            default:
                phone1 = num;
        }

        var phone = phone1;
        if(phone2) phone += '-'+phone2;
        if(phone3) phone += '-'+phone3;

        return phone;
    }

    function setModalMaxHeight(element) {
        this.$element     = $(element);
        this.$content     = this.$element.find('.modal-content');
        var borderWidth   = this.$content.outerHeight() - this.$content.innerHeight();
        var dialogMargin  = $(window).width() < 768 ? 20 : 60;
        var contentHeight = $(window).height() - (dialogMargin + borderWidth);
        var headerHeight  = this.$element.find('.modal-header').outerHeight() || 0;
        var footerHeight  = this.$element.find('.modal-footer').outerHeight() || 0;
        var maxHeight     = contentHeight - (headerHeight + footerHeight);

        this.$content.css({
            'overflow': 'hidden'
        });

        this.$element
            .find('.modal-body').css({
            'max-height': maxHeight,
            'overflow-y': 'auto'
        });
    }

    $('.modal').on('show.bs.modal', function() {
        $(this).show();
        setModalMaxHeight(this);
    });

    $(window).resize(function() {
        if ($('.modal.in').length != 0) {
            setModalMaxHeight($('.modal.in'));
        }
    });
</script>

</body>
</html>