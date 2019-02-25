<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>jQuery扑克牌算13点游戏代码</title>

<script src="js/poker/jquery.min.js"></script>
</head>
<style>
	*{
		margin: 0;
		padding: 0;
		list-style: none;
	}
	html,body{
		width: 100%;
		height: 100%;
		overflow: hidden;
	}
	body{
		background-image: url(images/poker/deck.png);
		background-size: cover;
		background-repeat: no-repeat;
	}
	main{
		width: 1000px;
		height: 100%;
		margin: 0 auto;
	}
	.imgBox{
		width: 100%;
		height: 500px;
		position: relative;
	}
	.pai{
		width: 90px;
		height: 140px;
		position: absolute;
		left: calc(50% - 45px);
		top: 0;
		background-size: 100% 100%;
		opacity: 0;
		border: 2px solid transparent;
	}
	.btnLeft,.btnRight{
		width: 120px;
		height: 50px;
		position: absolute;
		left: 0;
		right: 0;
		margin: 20px auto;
		background: palegreen;
		color: #fff;
		text-align: center;
		font-size: 30px;
		line-height: 50px;
		border-radius: 5px;
		cursor: pointer;
	}
	.active{
		border: 2px solid red;
	}
	.btnLeft{
		top: 450px;
	}
	.btnRight{
		top: 510px;
	}
</style>
<body>
	<main>
		<ul class="imgBox">
			<li class="pai"></li>
		</ul>
		<div class="btnLeft">&lt;</div>
		<div class="btnRight">&gt;</div>
	</main>
</body>
<script>
	var arr=['c','d','h','s'];
	var newarr=[];
	var obj={};
	var newobj={'1':'A','2':'2','3':'3','4':'4','5':'5','6':'6','7':'7','8':'8','9':'9','10':'T','11':'J','12':'Q','13':'K'};
	while(newarr.length<52){
		var num=Math.ceil(Math.random()*13);
		var color=arr[Math.floor(Math.random()*arr.length)];
		if(!obj[`${num}_${color}`]){  //obj[] 表示对象[属性名]
			obj[`${num}_${color}`]=true;
			newarr.push({num,color}); //json格式时，变量的名称作为属性名，变量的值作为属性值
		}
	}
	var n=0;
	for(var i=0;i<7;i++){
		for(var j=0;j<=i;j++){
			$('<li>').addClass('pai').data('num',newarr[n].num).prop('id',`${i}_${j}`).css('backgroundImage',`url(images/poker/${newobj[newarr[n].num]}${newarr[n].color}.png)`).delay(n*40).animate({top:i*50,left:455-i*50+100*j,opacity:1},300).appendTo('ul.imgBox');
			n++;
		}
	}
	for(var i=n;i<newarr.length;i++){
		$('<li>').addClass('pai zuo').data('num',newarr[i].num).css('backgroundImage',`url(images/poker/${newobj[newarr[i].num]}${newarr[i].color}.png)`).delay(i*40).animate({top:460,left:255,opacity:1},300).appendTo('ul.imgBox');
	}
	var m=null;
	$(document).on('click','li',function(){
		var id=$(this).prop('id');
		var next1=$(`#${parseInt(id.split("_")[0])+1}_${id.split("_")[1]}`);
		var next2=$(`#${parseInt(id.split("_")[0])+1}_${parseInt(id.split("_")[1])+1}`);
		if(next1[0]||next2[0]){
			return;
		}
		$(this).toggleClass('active');
		if($(this).hasClass('active')){
			$(this).animate({top:'-=20'},300);
		}else{
			$(this).animate({top:'+=20'},300);
		}

		if(!m){
			m=$(this);
			if($(this).data('num')==13){
				$('.active').animate({top:0,left:1000,opacity:0},300,function(){
					$('.active').remove();
				})
				m=null;
			}
			console.log(m.__proto__.data.f('num'));return;

		}else{
			if($(this).data('num')+m.data('num')==13){
				$('.active').animate({top:0,left:1000,opacity:0},300,function(){
					$('.active').remove();
				})
			}else{
				$('.active').removeClass('active').animate({top:'+=20'});
			}
			m=null;
		}
	})
	var index=0;
	$('.btnRight').click(function(){
		$('.zuo').eq(-1).animate({left:'+=400',zIndex:index++},300).removeClass('zuo').addClass('you');
	})
	$('.btnLeft').click(function(){
		$('.you').each(function(index,val){
			$(val).delay(index*40).animate({left:'-=400',zIndex:index},300).removeClass('you').addClass('zuo');
		})
	})
</script>

<div style="text-align:center;margin:50px 0; font:normal 14px/24px 'MicroSoft YaHei';">
<p>适用浏览器：360、FireFox、Chrome、Opera、傲游、搜狗、世界之窗. 不支持Safari、IE8及以下浏览器。</p>
<p>来源：<a href="http://www.php.cn/" target="_blank">php中文网</a></p>
</div>
</html>