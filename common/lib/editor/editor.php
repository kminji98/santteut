<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/lib/editor/css/editor.css">
      <script src="../../common/lib/editor/js/editor_loader.js" type="text/javascript" charset="utf-8"></script>
  </head>
  <body>
    <div class="body">
    	<!-- 에디터 시작 -->
    	<!--
    		@decsription
    		등록하기 위한 Form으로 상황에 맞게 수정하여 사용한다. Form 이름은 에디터를 생성할 때 설정값으로 설정한다.
    	-->
    	<form name="tx_editor_form" id="tx_editor_form" action="../../tour/admin/admin_add_package_query.php" method="post" enctype="multipart/form-data" accept-charset="utf-8">
  <!-- 작성폼 -->
        <table id="insert_form">
          <tr>
            <td><p>패키지 코드</p></td>
            <td> <input type="text" name="p_code" value="<?=$package_number?>" readonly> <p style="display:inline">종류</p>

              <select  name="p_place">
                <option value="">선택</option>;
                <option value="1">국내</option>;
                <option value="2">해외</option>;
              </select>

            </td>
          </tr>

          <tr>
            <td><p>메인 이미지</p></td>
            <td>  <input type="file" class="up_img" name="p_main_img1"> <input type="file" class="up_img" name="p_main_img2"> <input type="file" class="up_img" name="p_main_img3"> </td>
          </tr>

          <tr>
            <td><p>패키지 이름</p></td>
            <td> <input type="text" name="p_name" value="" size="50"> </td>

          </tr>

          <tr>
            <td><p>패키지 기간</p></td>
            <td> <select  name="p_period">
              <option value="">기간선택</option>;
              <?php
                for($i=1;$i<=9;$i++){
              ?>
              <option value="<?=$i?>"><?=$i?>일</option>;
              <?php
                if($i==9){
              ?>
              <option value="">10일 이상</option>;
              <?php
                }
              }
              ?>
            </select> </td>
          </tr>

          <tr>
            <td><p>출발일</p></td>
            <td> <input type="date" name="p_dp_date" value="" > </td>
          </tr>

          <tr>
            <td><p>출발 시간</p></td>
            <td> <input type="time" name="p_dp_time" value=""> </td>
          </tr>

          <tr>
            <td><p>도착 시간</p></td>
            <td> <input type="time" name="p_arr_time" value=""> </td>
          </tr>

          <tr>
            <td><p>패키지 요금</p></td>
            <td> <input type="text" name="p_pay" value=""><b>원</b> </td>
          </tr>

          <tr>
            <td><p>추가요금</p></td>
            <td> <b>Y</b><input type="radio" name="p_add_pay" value="1"> <b>N</b><input type="radio" name="p_add_pay" value="2"> </td>
          </tr>

          <tr>
            <td><p>자유일정</p></td>
            <td> <b>Y</b><input type="radio" name="p_free_time" value="1"> <b>N</b><input type="radio" name="p_free_time" value="2"> </td>
          </tr>

          <tr>
            <td><p>출발지</p></td>
            <td> <input id="p_dp_city" type="text" name="p_dp_city" value="" onclick="select_area()"> </td>
          </tr>

          <tr>
            <td><p>도착지</p></td>
            <td> <input id="p_arr_mt" type="text" name="p_arr_mt" value="" onclick="select_area()"> </td>
          </tr>

          <tr>
            <td><p>버스선택</p></td>
            <td><b>일반</b><input type="radio" name="p_bus" value="41"><b>우등</b><input type="radio" name="p_bus" value="28"></td>
          </tr>





    <!-- 다음에디터 -->
      <tr><td><p>상세페이지</p></td><td>
        <!-- 에디터 컨테이너 시작 -->
    		<div id="tx_trex_container" class="tx-editor-container">
    			<!-- 사이드바 -->
    			<div id="tx_sidebar" class="tx-sidebar">
    				<div class="tx-sidebar-boundary">
    					<!-- 사이드바 / 첨부 -->
    					<ul class="tx-bar tx-bar-left tx-nav-attach">
    						<!-- 이미지 첨부 버튼 시작 -->
    						<!--
    							@decsription
    							<li></li> 단위로 위치를 이동할 수 있다.
    						-->
    						<li class="tx-list">
    							<div unselectable="on" id="tx_image" class="tx-image tx-btn-trans">
    								<a href="javascript:;" title="사진" class="tx-text">사진</a>
    							</div>
    						</li>
    						<!-- 이미지 첨부 버튼 끝 -->
    						<li class="tx-list">
    							<div unselectable="on" id="tx_file" class="tx-file tx-btn-trans">
    								<a href="javascript:;" title="파일" class="tx-text">파일</a>
    							</div>
    						</li>
    						<li class="tx-list">
    							<div unselectable="on" id="tx_media" class="tx-media tx-btn-trans">
    								<a href="javascript:;" title="외부컨텐츠" class="tx-text">외부컨텐츠</a>
    							</div>
    						</li>
    						<li class="tx-list tx-list-extra">
    							<div unselectable="on" class="tx-btn-nlrbg tx-extra">
    								<a href="javascript:;" class="tx-icon" title="버튼 더보기">버튼 더보기</a>
    							</div>
    							<ul class="tx-extra-menu tx-menu" style="left:-48px;" unselectable="on">
    								<!--
    									@decsription
    									일부 버튼들을 빼서 레이어로 숨기는 기능을 원할 경우 이 곳으로 이동시킬 수 있다.
    								-->
    							</ul>
    						</li>
    					</ul>
    					<!-- 사이드바 / 우측영역 -->
    					<ul class="tx-bar tx-bar-right">
    						<li class="tx-list">
    							<div unselectable="on" class="tx-btn-lrbg tx-fullscreen" id="tx_fullscreen">
    								<a href="javascript:;" class="tx-icon" title="넓게쓰기 (Ctrl+M)">넓게쓰기</a>
    							</div>
    						</li>
    					</ul>
    					<ul class="tx-bar tx-bar-right tx-nav-opt">
    						<li class="tx-list">
    							<div unselectable="on" class="tx-switchtoggle" id="tx_switchertoggle">
    								<a href="javascript:;" title="에디터 타입">에디터</a>
    							</div>
    						</li>
    					</ul>
    				</div>
    			</div>

    			<!-- 툴바 - 기본 시작 -->
    			<!--
    				@decsription
    				툴바 버튼의 그룹핑의 변경이 필요할 때는 위치(왼쪽, 가운데, 오른쪽) 에 따라 <li> 아래의 <div>의 클래스명을 변경하면 된다.
    				tx-btn-lbg: 왼쪽, tx-btn-bg: 가운데, tx-btn-rbg: 오른쪽, tx-btn-lrbg: 독립적인 그룹

    				드롭다운 버튼의 크기를 변경하고자 할 경우에는 넓이에 따라 <li> 아래의 <div>의 클래스명을 변경하면 된다.
    				tx-slt-70bg, tx-slt-59bg, tx-slt-42bg, tx-btn-43lrbg, tx-btn-52lrbg, tx-btn-57lrbg, tx-btn-71lrbg
    				tx-btn-48lbg, tx-btn-48rbg, tx-btn-30lrbg, tx-btn-46lrbg, tx-btn-67lrbg, tx-btn-49lbg, tx-btn-58bg, tx-btn-46bg, tx-btn-49rbg
    			-->
    			<div id="tx_toolbar_basic" class="tx-toolbar tx-toolbar-basic"><div class="tx-toolbar-boundary">
    				<ul class="tx-bar tx-bar-left">
    					<li class="tx-list">
    						<div id="tx_fontfamily" unselectable="on" class="tx-slt-70bg tx-fontfamily">
    							<a href="javascript:;" title="글꼴">굴림</a>
    						</div>
    						<div id="tx_fontfamily_menu" class="tx-fontfamily-menu tx-menu" unselectable="on"></div>
    					</li>
    				</ul>
    				<ul class="tx-bar tx-bar-left">
    					<li class="tx-list">
    						<div unselectable="on" class="tx-slt-42bg tx-fontsize" id="tx_fontsize">
    							<a href="javascript:;" title="글자크기">9pt</a>
    						</div>
    						<div id="tx_fontsize_menu" class="tx-fontsize-menu tx-menu" unselectable="on"></div>
    					</li>
    				</ul>
    				<ul class="tx-bar tx-bar-left tx-group-font">

    					<li class="tx-list">
    						<div unselectable="on" class="		 tx-btn-lbg 	tx-bold" id="tx_bold">
    							<a href="javascript:;" class="tx-icon" title="굵게 (Ctrl+B)">굵게</a>
    						</div>
    					</li>
    					<li class="tx-list">
    						<div unselectable="on" class="		 tx-btn-bg 	tx-underline" id="tx_underline">
    							<a href="javascript:;" class="tx-icon" title="밑줄 (Ctrl+U)">밑줄</a>
    						</div>
    					</li>
    					<li class="tx-list">
    						<div unselectable="on" class="		 tx-btn-bg 	tx-italic" id="tx_italic">
    							<a href="javascript:;" class="tx-icon" title="기울임 (Ctrl+I)">기울임</a>
    						</div>
    					</li>
    					<li class="tx-list">
    						<div unselectable="on" class="		 tx-btn-bg 	tx-strike" id="tx_strike">
    							<a href="javascript:;" class="tx-icon" title="취소선 (Ctrl+D)">취소선</a>
    						</div>
    					</li>
    					<li class="tx-list">
    						<div unselectable="on" class="		 tx-slt-tbg 	tx-forecolor" id="tx_forecolor">
    							<a href="javascript:;" class="tx-icon" title="글자색">글자색</a>
    							<a href="javascript:;" class="tx-arrow" title="글자색 선택">글자색 선택</a>
    						</div>
    						<div id="tx_forecolor_menu" class="tx-menu tx-forecolor-menu tx-colorpallete"
    							 unselectable="on"></div>
    					</li>
    					<li class="tx-list">
    						<div unselectable="on" class="		 tx-slt-brbg 	tx-backcolor" id="tx_backcolor">
    							<a href="javascript:;" class="tx-icon" title="글자 배경색">글자 배경색</a>
    							<a href="javascript:;" class="tx-arrow" title="글자 배경색 선택">글자 배경색 선택</a>
    						</div>
    						<div id="tx_backcolor_menu" class="tx-menu tx-backcolor-menu tx-colorpallete"
    							 unselectable="on"></div>
    					</li>
    				</ul>
    				<ul class="tx-bar tx-bar-left tx-group-align">
    					<li class="tx-list">
    						<div unselectable="on" class="		 tx-btn-lbg 	tx-alignleft" id="tx_alignleft">
    							<a href="javascript:;" class="tx-icon" title="왼쪽정렬 (Ctrl+,)">왼쪽정렬</a>
    						</div>
    					</li>
    					<li class="tx-list">
    						<div unselectable="on" class="		 tx-btn-bg 	tx-aligncenter" id="tx_aligncenter">
    							<a href="javascript:;" class="tx-icon" title="가운데정렬 (Ctrl+.)">가운데정렬</a>
    						</div>
    					</li>
    					<li class="tx-list">
    						<div unselectable="on" class="		 tx-btn-bg 	tx-alignright" id="tx_alignright">
    							<a href="javascript:;" class="tx-icon" title="오른쪽정렬 (Ctrl+/)">오른쪽정렬</a>
    						</div>
    					</li>
    					<li class="tx-list">
    						<div unselectable="on" class="		 tx-btn-rbg 	tx-alignfull" id="tx_alignfull">
    							<a href="javascript:;" class="tx-icon" title="양쪽정렬">양쪽정렬</a>
    						</div>
    					</li>
    				</ul>
    				<ul class="tx-bar tx-bar-left tx-group-tab">
    					<li class="tx-list">
    						<div unselectable="on" class="		 tx-btn-lbg 	tx-indent" id="tx_indent">
    							<a href="javascript:;" title="들여쓰기 (Tab)" class="tx-icon">들여쓰기</a>
    						</div>
    					</li>
    					<li class="tx-list">
    						<div unselectable="on" class="		 tx-btn-rbg 	tx-outdent" id="tx_outdent">
    							<a href="javascript:;" title="내어쓰기 (Shift+Tab)" class="tx-icon">내어쓰기</a>
    						</div>
    					</li>
    				</ul>
    				<ul class="tx-bar tx-bar-left tx-group-list">
    					<li class="tx-list">
    						<div unselectable="on" class="tx-slt-31lbg tx-lineheight" id="tx_lineheight">
    							<a href="javascript:;" class="tx-icon" title="줄간격">줄간격</a>
    							<a href="javascript:;" class="tx-arrow" title="줄간격">줄간격 선택</a>
    						</div>
    						<div id="tx_lineheight_menu" class="tx-lineheight-menu tx-menu" unselectable="on"></div>
    					</li>
    					<li class="tx-list">
    						<div unselectable="on" class="tx-slt-31rbg tx-styledlist" id="tx_styledlist">
    							<a href="javascript:;" class="tx-icon" title="리스트">리스트</a>
    							<a href="javascript:;" class="tx-arrow" title="리스트">리스트 선택</a>
    						</div>
    						<div id="tx_styledlist_menu" class="tx-styledlist-menu tx-menu" unselectable="on"></div>
    					</li>
    				</ul>
    				<ul class="tx-bar tx-bar-left tx-group-etc">
    					<li class="tx-list">
    						<div unselectable="on" class="		 tx-btn-lbg 	tx-emoticon" id="tx_emoticon">
    							<a href="javascript:;" class="tx-icon" title="이모티콘">이모티콘</a>
    						</div>
    						<div id="tx_emoticon_menu" class="tx-emoticon-menu tx-menu" unselectable="on"></div>
    					</li>
    					<li class="tx-list">
    						<div unselectable="on" class="		 tx-btn-bg 	tx-link" id="tx_link">
    							<a href="javascript:;" class="tx-icon" title="링크 (Ctrl+K)">링크</a>
    						</div>
    						<div id="tx_link_menu" class="tx-link-menu tx-menu"></div>
    					</li>
    					<li class="tx-list">
    						<div unselectable="on" class="		 tx-btn-bg 	tx-specialchar" id="tx_specialchar">
    							<a href="javascript:;" class="tx-icon" title="특수문자">특수문자</a>
    						</div>
    						<div id="tx_specialchar_menu" class="tx-specialchar-menu tx-menu"></div>
    					</li>
    					<li class="tx-list">
    						<div unselectable="on" class="		 tx-btn-bg 	tx-table" id="tx_table">
    							<a href="javascript:;" class="tx-icon" title="표만들기">표만들기</a>
    						</div>
    						<div id="tx_table_menu" class="tx-table-menu tx-menu" unselectable="on">
    							<div class="tx-menu-inner">
    								<div class="tx-menu-preview"></div>
    								<div class="tx-menu-rowcol"></div>
    								<div class="tx-menu-deco"></div>
    								<div class="tx-menu-enter"></div>
    							</div>
    						</div>
    					</li>
    					<li class="tx-list">
    						<div unselectable="on" class="		 tx-btn-rbg 	tx-horizontalrule" id="tx_horizontalrule">
    							<a href="javascript:;" class="tx-icon" title="구분선">구분선</a>
    						</div>
    						<div id="tx_horizontalrule_menu" class="tx-horizontalrule-menu tx-menu" unselectable="on"></div>
    					</li>
    				</ul>
    				<ul class="tx-bar tx-bar-left">
    					<li class="tx-list">
    						<div unselectable="on" class="		 tx-btn-lbg 	tx-richtextbox" id="tx_richtextbox">
    							<a href="javascript:;" class="tx-icon" title="글상자">글상자</a>
    						</div>
    						<div id="tx_richtextbox_menu" class="tx-richtextbox-menu tx-menu">
    							<div class="tx-menu-header">
    								<div class="tx-menu-preview-area">
    									<div class="tx-menu-preview"></div>
    								</div>
    								<div class="tx-menu-switch">
    									<div class="tx-menu-simple tx-selected"><a><span>간단 선택</span></a></div>
    									<div class="tx-menu-advanced"><a><span>직접 선택</span></a></div>
    								</div>
    							</div>
    							<div class="tx-menu-inner">
    							</div>
    							<div class="tx-menu-footer">
    								<img class="tx-menu-confirm"
                       src="../../common/lib/editor/images/icon/editor/btn_confirm.gif?rv=1.0.1" alt=""/>
    								<img class="tx-menu-cancel" hspace="3"
    									 src="../../common/lib/editor/images/icon/editor/btn_cancel.gif?rv=1.0.1" alt=""/>
    							</div>
    						</div>
    					</li>
    					<li class="tx-list">
    						<div unselectable="on" class="		 tx-btn-bg 	tx-quote" id="tx_quote">
    							<a href="javascript:;" class="tx-icon" title="인용구 (Ctrl+Q)">인용구</a>
    						</div>
    						<div id="tx_quote_menu" class="tx-quote-menu tx-menu" unselectable="on"></div>
    					</li>
    					<li class="tx-list">
    						<div unselectable="on" class="		 tx-btn-bg 	tx-background" id="tx_background">
    							<a href="javascript:;" class="tx-icon" title="배경색">배경색</a>
    						</div>
    						<div id="tx_background_menu" class="tx-menu tx-background-menu tx-colorpallete"
    							 unselectable="on"></div>
    					</li>
    					<li class="tx-list">
    						<div unselectable="on" class="		 tx-btn-rbg 	tx-dictionary" id="tx_dictionary">
    							<a href="javascript:;" class="tx-icon" title="사전">사전</a>
    						</div>
    					</li>
    				</ul>
    				<ul class="tx-bar tx-bar-left tx-group-undo">
    					<li class="tx-list">
    						<div unselectable="on" class="		 tx-btn-lbg 	tx-undo" id="tx_undo">
    							<a href="javascript:;" class="tx-icon" title="실행취소 (Ctrl+Z)">실행취소</a>
    						</div>
    					</li>
    					<li class="tx-list">
    						<div unselectable="on" class="		 tx-btn-rbg 	tx-redo" id="tx_redo">
    							<a href="javascript:;" class="tx-icon" title="다시실행 (Ctrl+Y)">다시실행</a>
    						</div>
    					</li>
    				</ul>
    				<ul class="tx-bar tx-bar-right">
    					<li class="tx-list">
    						<div unselectable="on" class="tx-btn-nlrbg tx-advanced" id="tx_advanced">
    							<a href="javascript:;" class="tx-icon" title="툴바 더보기">툴바 더보기</a>
    						</div>
    					</li>
    				</ul>
    			</div></div>
    			<!-- 툴바 - 기본 끝 -->
    			<!-- 툴바 - 더보기 시작 -->
    			<div id="tx_toolbar_advanced" class="tx-toolbar tx-toolbar-advanced"><div class="tx-toolbar-boundary">
    				<ul class="tx-bar tx-bar-left">
    					<li class="tx-list">
    						<div class="tx-tableedit-title"></div>
    					</li>
    				</ul>

    				<ul class="tx-bar tx-bar-left tx-group-align">
    					<li class="tx-list">
    						<div unselectable="on" class="tx-btn-lbg tx-mergecells" id="tx_mergecells">
    							<a href="javascript:;" class="tx-icon2" title="병합">병합</a>
    						</div>
    						<div id="tx_mergecells_menu" class="tx-mergecells-menu tx-menu" unselectable="on"></div>
    					</li>
    					<li class="tx-list">
    						<div unselectable="on" class="tx-btn-bg tx-insertcells" id="tx_insertcells">
    							<a href="javascript:;" class="tx-icon2" title="삽입">삽입</a>
    						</div>
    						<div id="tx_insertcells_menu" class="tx-insertcells-menu tx-menu" unselectable="on"></div>
    					</li>
    					<li class="tx-list">
    						<div unselectable="on" class="tx-btn-rbg tx-deletecells" id="tx_deletecells">
    							<a href="javascript:;" class="tx-icon2" title="삭제">삭제</a>
    						</div>
    						<div id="tx_deletecells_menu" class="tx-deletecells-menu tx-menu" unselectable="on"></div>
    					</li>
    				</ul>

    				<ul class="tx-bar tx-bar-left tx-group-align">
    					<li class="tx-list">
    						<div id="tx_cellslinepreview" unselectable="on" class="tx-slt-70lbg tx-cellslinepreview">
    							<a href="javascript:;" title="선 미리보기"></a>
    						</div>
    						<div id="tx_cellslinepreview_menu" class="tx-cellslinepreview-menu tx-menu"
    							 unselectable="on"></div>
    					</li>
    					<li class="tx-list">
    						<div id="tx_cellslinecolor" unselectable="on" class="tx-slt-tbg tx-cellslinecolor">
    							<a href="javascript:;" class="tx-icon2" title="선색">선색</a>

    							<div class="tx-colorpallete" unselectable="on"></div>
    						</div>
    						<div id="tx_cellslinecolor_menu" class="tx-cellslinecolor-menu tx-menu tx-colorpallete"
    							 unselectable="on"></div>
    					</li>
    					<li class="tx-list">
    						<div id="tx_cellslineheight" unselectable="on" class="tx-btn-bg tx-cellslineheight">
    							<a href="javascript:;" class="tx-icon2" title="두께">두께</a>

    						</div>
    						<div id="tx_cellslineheight_menu" class="tx-cellslineheight-menu tx-menu"
    							 unselectable="on"></div>
    					</li>
    					<li class="tx-list">
    						<div id="tx_cellslinestyle" unselectable="on" class="tx-btn-bg tx-cellslinestyle">
    							<a href="javascript:;" class="tx-icon2" title="스타일">스타일</a>
    						</div>
    						<div id="tx_cellslinestyle_menu" class="tx-cellslinestyle-menu tx-menu" unselectable="on"></div>
    					</li>
    					<li class="tx-list">
    						<div id="tx_cellsoutline" unselectable="on" class="tx-btn-rbg tx-cellsoutline">
    							<a href="javascript:;" class="tx-icon2" title="테두리">테두리</a>

    						</div>
    						<div id="tx_cellsoutline_menu" class="tx-cellsoutline-menu tx-menu" unselectable="on"></div>
    					</li>
    				</ul>
    				<ul class="tx-bar tx-bar-left">
    					<li class="tx-list">
    						<div id="tx_tablebackcolor" unselectable="on" class="tx-btn-lrbg tx-tablebackcolor"
    							 style="background-color:#9aa5ea;">
    							<a href="javascript:;" class="tx-icon2" title="테이블 배경색">테이블 배경색</a>
    						</div>
    						<div id="tx_tablebackcolor_menu" class="tx-tablebackcolor-menu tx-menu tx-colorpallete"
    							 unselectable="on"></div>
    					</li>
    				</ul>
    				<ul class="tx-bar tx-bar-left">
    					<li class="tx-list">
    						<div id="tx_tabletemplate" unselectable="on" class="tx-btn-lrbg tx-tabletemplate">
    							<a href="javascript:;" class="tx-icon2" title="테이블 서식">테이블 서식</a>
    						</div>
    						<div id="tx_tabletemplate_menu" class="tx-tabletemplate-menu tx-menu tx-colorpallete"
    							 unselectable="on"></div>
    					</li>
    				</ul>

    			</div></div>
    			<!-- 툴바 - 더보기 끝 -->
    			<!-- 편집영역 시작 -->
    				<!-- 에디터 Start -->
    	<div id="tx_canvas" class="tx-canvas">
    		<div id="tx_loading" class="tx-loading"><div><img src="../../common/lib/editor/images/icon/editor/loading2.png" width="113" height="21" align="absmiddle"/></div></div>
    		<div id="tx_canvas_wysiwyg_holder" class="tx-holder" style="display:block;">
    			<iframe id="tx_canvas_wysiwyg" name="tx_canvas_wysiwyg" allowtransparency="true" frameborder="0"></iframe>
    		</div>
    		<div class="tx-source-deco">
    			<div id="tx_canvas_source_holder" class="tx-holder">
    				<textarea id="tx_canvas_source" rows="30" cols="30"></textarea>
    			</div>
    		</div>
    		<div id="tx_canvas_text_holder" class="tx-holder" name="p_detail_content">
    			<textarea id="tx_canvas_text" rows="30" cols="30"></textarea>
    		</div>
    	</div>
    					<!-- 높이조절 Start -->
    	<div id="tx_resizer" class="tx-resize-bar">
    		<div class="tx-resize-bar-bg"></div>
    		<img id="tx_resize_holder" src="../../common/lib/editor/images/icon/editor/skin/01/btn_drag01.gif" width="58" height="12" unselectable="on" alt="" />
    	</div>
    					<div class="tx-side-bi" id="tx_side_bi">
    	</div>
    				<!-- 편집영역 끝 -->
    			<!-- 첨부박스 시작 -->
    				<!-- 파일첨부박스 Start -->
    	<div id="tx_attach_div" class="tx-attach-div">
    		<div id="tx_attach_txt" class="tx-attach-txt">파일 첨부</div>
    		<div id="tx_attach_box" class="tx-attach-box">
    			<div class="tx-attach-box-inner">
    				<div id="tx_attach_preview" class="tx-attach-preview"><p></p><img src="../../common/lib/editor/images/icon/editor/pn_preview.gif" width="147" height="108" unselectable="on"/></div>
    				<div class="tx-attach-main">
    					<div id="tx_upload_progress" class="tx-upload-progress"><div>0%</div><p>파일을 업로드하는 중입니다.</p></div>
    					<ul class="tx-attach-top">
    						<li id="tx_attach_delete" class="tx-attach-delete"><a>전체삭제</a></li>
    						<li id="tx_attach_size" class="tx-attach-size">
    							파일: <span id="tx_attach_up_size" class="tx-attach-size-up"></span>/<span id="tx_attach_max_size"></span>
    						</li>
    						<li id="tx_attach_tools" class="tx-attach-tools">
    						</li>
    					</ul>
    					<ul id="tx_attach_list" class="tx-attach-list"></ul>
    				</div>
    			</div>
    		</div>
    	</div>
    				<!-- 첨부박스 끝 -->
    		</div>
    		<!-- 에디터 컨테이너 끝 -->
         </td></tr>
         <tr>
           <td colspan="2" id="insert_btn_td">
             <input type="button" id="insert_btn" onclick="check_input()" value="패키지등록하기">
           </td>
         </tr>
        </table><br><br><br>

    	</form>
    </div>
    <!-- 에디터 끝 -->
    <script type="text/javascript">
    	var config = {
    		txHost: '', /* 런타임 시 리소스들을 로딩할 때 필요한 부분으로, 경로가 변경되면 이 부분 수정이 필요. ex) http://xxx.xxx.com */
    		txPath: '', /* 런타임 시 리소스들을 로딩할 때 필요한 부분으로, 경로가 변경되면 이 부분 수정이 필요. ex) /xxx/xxx/ */
    		txService: 'sample', /* 수정필요없음. */
    		txProject: 'sample', /* 수정필요없음. 프로젝트가 여러개일 경우만 수정한다. */
    		initializedId: "", /* 대부분의 경우에 빈문자열 */
    		wrapper: "tx_trex_container", /* 에디터를 둘러싸고 있는 레이어 이름(에디터 컨테이너) */
    		form: 'tx_editor_form'+"", /* 등록하기 위한 Form 이름 */
    		txIconPath: "images/icon/editor/", /*에디터에 사용되는 이미지 디렉터리, 필요에 따라 수정한다. */
    		txDecoPath: "images/deco/contents/", /*본문에 사용되는 이미지 디렉터리, 서비스에서 사용할 때는 완성된 컨텐츠로 배포되기 위해 절대경로로 수정한다. */
    		canvas: {
                exitEditor:{
                    /*
                    desc:'빠져 나오시려면 shift+b를 누르세요.',
                    hotKey: {
                        shiftKey:true,
                        keyCode:66
                    },
                    nextElement: document.getElementsByTagName('button')[0]
                    */
                },
    			styles: {
    				color: "#123456", /* 기본 글자색 */
    				fontFamily: "굴림", /* 기본 글자체 */
    				fontSize: "10pt", /* 기본 글자크기 */
    				backgroundColor: "#fff", /*기본 배경색 */
    				lineHeight: "1.5", /*기본 줄간격 */
    				padding: "8px" /* 위지윅 영역의 여백 */
    			},
    			showGuideArea: false
    		},
    		events: {
    			preventUnload: false
    		},
    		sidebar: {
    			attachbox: {
    				show: true,
    				confirmForDeleteAll: true
    			}
    		},
    		size: {
    			contentWidth: 700 /* 지정된 본문영역의 넓이가 있을 경우에 설정 */
    		}
    	};

    	EditorJSLoader.ready(function(Editor) {
    		var editor = new Editor(config);
    	});

    </script>

    <!-- Sample: Saving Contents -->
    <script type="text/javascript">
    var map_window;
    function select_area(){
      var popupX = (window.screen.width / 2) - (800 / 2);
      var popupY= (window.screen.height /2) - (500 / 2);
      window.open('../../common/lib/google3.php', '', 'status=no, width=800, height=500, left='+ popupX + ', top='+ popupY + ', screenX='+ popupX + ', screenY= '+ popupY);

    }
    	/* 예제용 함수 */
    	function saveContent() {
    		Editor.save(); // 이 함수를 호출하여 글을 등록하면 된다
    	}

    	/**
    	 * Editor.save()를 호출한 경우 데이터가 유효한지 검사하기 위해 부르는 콜백함수로
    	 * 상황에 맞게 수정하여 사용한다.
    	 * 모든 데이터가 유효할 경우에 true를 리턴한다.
    	 * @function
    	 * @param {Object} editor - 에디터에서 넘겨주는 editor 객체
    	 * @returns {Boolean} 모든 데이터가 유효할 경우에 true
    	 */
    	function validForm(editor) {
    		// Place your validation logic here

    		// sample : validate that content exists
    		var validator = new Trex.Validator();
    		var content = editor.getContent();
    		if (!validator.exists(content)) {
    			alert('내용을 입력하세요');
    			return false;
    		}

    		return true;
    	}

    	/**
    	 * Editor.save()를 호출한 경우 validForm callback 이 수행된 이후
    	 * 실제 form submit을 위해 form 필드를 생성, 변경하기 위해 부르는 콜백함수로
    	 * 각자 상황에 맞게 적절히 응용하여 사용한다.
    	 * @function
    	 * @param {Object} editor - 에디터에서 넘겨주는 editor 객체
    	 * @returns {Boolean} 정상적인 경우에 true
    	 */
    	function setForm(editor) {
            var i, input;
            var form = editor.getForm();
            var content = editor.getContent();

            // 본문 내용을 필드를 생성하여 값을 할당하는 부분
            var textarea = document.createElement('textarea');
            textarea.name = 'content';
            textarea.value = content;
            form.createField(textarea);

            /* 아래의 코드는 첨부된 데이터를 필드를 생성하여 값을 할당하는 부분으로 상황에 맞게 수정하여 사용한다.
             첨부된 데이터 중에 주어진 종류(image,file..)에 해당하는 것만 배열로 넘겨준다. */
            var images = editor.getAttachments('image');
            for (i = 0; i < images.length; i++) {
                // existStage는 현재 본문에 존재하는지 여부
                if (images[i].existStage) {
                    // data는 팝업에서 execAttach 등을 통해 넘긴 데이터
                    alert('attachment information - image[' + i + '] \r\n' + JSON.stringify(images[i].data));
                    input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'attach_image';
                    input.value = images[i].data.imageurl;  // 예에서는 이미지경로만 받아서 사용
                    form.createField(input);
                }
            }

            var files = editor.getAttachments('file');
            for (i = 0; i < files.length; i++) {
                input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'attach_file';
                input.value = files[i].data.attachurl;
                form.createField(input);
            }
            return true;
    	}
    </script>
    <!-- <div><button onclick='saveContent()' id="btn_submit">저장</button></div> -->
    <!-- End: Saving Contents -->

    <!-- Sample: Loading Contents -->
    <textarea id="sample_contents_source" style="display:none;">
    	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    	<p style="text-align: center;">
    		<img src="http://cfile273.uf.daum.net/image/2064CD374EE1ACCB0F15C8" class="tx-daum-image" style="clear: none; float: none;"/>
    	</p>﻿
    	<p>
    		<a href="http://cfile297.uf.daum.net/attach/207C8C1B4AA4F5DC01A644"><img src="snapshot/images/icon/p_gif_s.gif"/> editor_bi.gif</a>
    	</p>
    </textarea>
    <script type="text/javascript">
    	// function loadContent() {
    	// 	var attachments = {};
    	// 	attachments['image'] = [];
    	// 	attachments['image'].push({
    	// 		'attacher': 'image',
    	// 		'data': {
    	// 			'imageurl': 'http://cfile273.uf.daum.net/image/2064CD374EE1ACCB0F15C8',
    	// 			'filename': 'github.gif',
    	// 			'filesize': 59501,
    	// 			'originalurl': 'http://cfile273.uf.daum.net/original/2064CD374EE1ACCB0F15C8',
    	// 			'thumburl': 'http://cfile273.uf.daum.net/P150x100/2064CD374EE1ACCB0F15C8'
    	// 		}
    	// 	});
    	// 	attachments['file'] = [];
    	// 	attachments['file'].push({
    	// 		'attacher': 'file',
    	// 		'data': {
    	// 			'attachurl': 'http://cfile297.uf.daum.net/attach/207C8C1B4AA4F5DC01A644',
    	// 			'filemime': 'image/gif',
    	// 			'filename': 'editor_bi.gif',
    	// 			'filesize': 640
    	// 		}
    	// 	});
    	// 	/* 저장된 컨텐츠를 불러오기 위한 함수 호출 */
    	// 	Editor.modify({
    	// 		"attachments": function () { /* 저장된 첨부가 있을 경우 배열로 넘김, 위의 부분을 수정하고 아래 부분은 수정없이 사용 */
    	// 			var allattachments = [];
    	// 			for (var i in attachments) {
    	// 				allattachments = allattachments.concat(attachments[i]);
    	// 			}
    	// 			return allattachments;
    	// 		}(),
    	// 		"content": document.getElementById("sample_contents_source") /* 내용 문자열, 주어진 필드(textarea) 엘리먼트 */
    	// 	});
    	// }
    </script>
    <!-- <div><button onclick='loadContent()'>SAMPLE - load contents to editor</button></div> -->
    <!-- End: Loading Contents -->

  </body>

</html>
