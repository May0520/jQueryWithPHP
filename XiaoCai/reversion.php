<div class="reversion-page">
	
<header>
	<nav>
		<div class="header-title">
			<div class="header-back"><span class="glyphicon glyphicon-menu-left"></span></div>
			<div class="header-main-title">收到的回复</div>
		</div>
	</nav>
</header>

<section>
	<div class="reversion-page-content">
		
	</div>

	<div class="loading">
		<div class="loading-main"><span class="glyphicon glyphicon-option-horizontal"></span><span class="glyphicon glyphicon-option-horizontal"></span></div>
	</div>
</section>

</div>

<script type="text/javascript">
	//退回按钮事件
	$('.header-back').click(function(){
		backPreviosPage('reversion.php');
	});

	displayALertForm('正在加载...');
	getReply(localStorage.tokenID,function(data){
		if(data!=''){
			var jsonData=JSON.parse(data);
			var replyList=jsonData['data'];
			var replyListHTMLDom='';
			if(replyList!=null || replyList!='' || replyList!='null'){
				var reversionStatus;
				var reversionTips;
				for (var i = 0; i < replyList.length; i++) {
					if(replyList[i]['status']==='1'){
						//新信息
						reversionStatus='reversion-new';
						reversionTips='<div class="reversion-right">NEW</div>';
					}else{
						//已读信息
						reversionStatus='reversion-looked';
						reversionTips='';
					}
					replyListHTMLDom+='	<div class="reading-list-a reversion-list-a '+reversionStatus+'"><div style="background:url('+replyList[i]['article_image']+') no-repeat scroll center center transparent;background-size:cover;" class="reading-list-img reversion-list-img"></div><div class="reversion-whole"><div class="reversion-list-all-content"><div class="reversion-list-all-title"><p>'+replyList[i]['article_title']+'</p></div></div><div class="reading-list-all-foot"><div class="reversion-list-foot-table"><ul><li><span class="glyphicon glyphicon-bookmark"></span> '+replyType[parseInt(replyList[i]['type'])-1]+'</li><li><span class="glyphicon glyphicon-time"></span> '+formatDate(replyList[i]['created_time'].split(' ')[0])+'</li></ul></div></div></div>'+reversionTips+'</div>';
				};	
			}else{
				displayALertForm('暂时没有消息喔');
				displayNoData('再怎么找都没有啦');
			}
			$('.reversion-page-content').append(replyListHTMLDom+'<div class="padding-div-row"></div>');
		}else{
			displayALertForm('获取失败,请重试');
		}
	});

	$('section').css('marginTop',$('header').height()+10);
</script>
