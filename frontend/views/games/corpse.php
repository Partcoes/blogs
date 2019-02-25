<link rel="stylesheet" href="/css/page.css">
<script src="js/corpse/Cfunction.js??js/corpse/CPlants.js??js/corpse/CZombie.js??js/corpse/level/0.js" type="text/javascript"></script>
<!--<script src="js/corpse/CPlants.js" type="text/javascript"></script>-->
<!--<script src="js/corpse/CZombie.js" type="text/javascript"></script>-->
<script id="JSPVZ" type="text/javascript"></script>
<script id="JSProcess" type="text/javascript"></script>
<body id="dBody" topmargin="0" leftmargin="0" oncontextmenu="return false" ondragstart="return false" onselectstart="return false" bgcolor="#008080">

<!--进度条-->
<div id="dFlagMeter" style="visibility:hidden;position:absolute;z-index:255;left:50px;top:280px;width:500px;height:40px">
	<div id="dFlagMeterTitle" style="position:absolute;text-align:right"><div id="dFlagMeterTitleB"><span id="sFlagMeterTitleF"></span></div></div>
	<div id="dFlagMeterContent" style="position:absolute;left:344px;width:157px;height:40px">
		<img id="imgFlagMeterEmpty" border="0" src="images/corpse/interface/FlagMeterEmpty.png" style="top: 17px">
		<img id="imgFlagMeterFull" border="0" src="images/corpse/interface/FlagMeterFull.png" style="top: 17px;clip:rect(0,auto,auto,157px)">
		<img id="imgFlag1" src="images/corpse/interface/FlagMeterParts2.png" style="left: 10px; top: 14px;display:none">
		<img id="imgFlag2" src="images/corpse/interface/FlagMeterParts2.png" style="left: 40px; top: 14px;display:none">
		<img id="imgFlag3" src="images/corpse/interface/FlagMeterParts2.png" style="left: 70px; top: 14px;display:none">
		<img id="imgFlag4" src="images/corpse/interface/FlagMeterParts2.png" style="left: 100px; top: 14px;display:none">
		<img id="imgGQJC" src="images/corpse/interface/FlagMeterLevelProgress.png" style="left: 35px; top: 29px;display:block">
		<img id="imgFlagHead" src="images/corpse/interface/FlagMeterParts1.png" style="left: 139px; top: 13px">
	</div>
</div>

<!--选项界面-->
<div id="dSurface" class="WindowFrame" style="display:none;z-index:255">
	<div id="iSurfaceBackground">
		<map name="FPMap0">
			<area href="javascript:void(0)" shape="rect" coords="641, 466, 724, 527" onClick="ShowOptions()">
			<area href="javascript:void(0)" shape="rect" coords="718, 512, 790, 558" onClick="ShowHelp()">
			<area href="javascript:void(0)" shape="rect" coords="800, 495, 879, 548" onClick="SetNone($('dSurface'))">
		</map>
		<img src="images/corpse/Surface.png" usemap="#FPMap0" border="0">
		<div style="position: absolute;background:url('images/SelectorScreenStartAdventur.png');left:474px;top:80px;width:331px;height:146px;cursor:pointer" onMouseOver="this.style.backgroundPosition='bottom'" onMouseOut="this.style.backgroundPosition='top'" onClick="ShowLevel()"></div>
		<div style="position: absolute;background:url('images/SelectorScreenSurvival.png');left:474px;top:203px;width:313px;height:131px;cursor:pointer" onMouseOver="this.style.backgroundPosition='bottom'" onMouseOut="this.style.backgroundPosition='top'" onClick="ShowMiniGame()"></div>
	</div>
	<div id="dSurfaceBack">
		<div id="dHelp" onClick="HiddenHelp()"></div>
		<div id="dOptionsMenuback">
			<div id="dOptionsMenu" style="line-height:40px;position:absolute;width:100%;height:100%;display:none;font-weight:bold">
				<div style="margin-top:150px;height:40px"><input type="checkbox" id="cAutoSun" value="1" onChange="CheckAutoSun(this)"><label for="cAutoSun" id="lAutoSun" style="color:#FFF">自动拾取阳光</label></div>
				<div class="BigLevel" style="cursor:pointer" onClick="SelectModal(oS.Lvl)">重新开始</div>
				<div class="BigLevel" style="cursor:pointer" onClick="HiddenOptions();SelectModal(0);SetBlock($('dSurface'),$('iSurfaceBackground'))">返回菜单</div>
				<div class="OptionsMenuButton" style="margin-top:108px" onMouseDown="OptionsMenuDown(this,$('sOptionsMenu'))" onMouseUp="OptionsMenuUP(this,$('sOptionsMenu'));HiddenOptions()"><span id="sOptionsMenu" class="OptionsMenuButtonSpan">返回游戏</span></div>
			</div>
			<div id="dSelectLevel">
				<div class="TitleBigContainer">
					<div id="dTitleSmallContainer" class="TitleSmallContainer" style="display:none">
						<div id="dBigLvl1">
							<div class="BigLevel">&nbsp;&nbsp;&nbsp;第一大关&nbsp;&nbsp;&nbsp;<span style="cursor:pointer" onClick="SetNone($('dBigLvl1'));SetBlock($('dBigLvl2'))" title="点击进入到第二大关">>></span></div>
							<div onClick="SelectModal(1)" class="SmallLevel">第一关</div>
							<div onClick="SelectModal(2)" class="SmallLevel">第二关</div>
							<div onClick="SelectModal(3)" class="SmallLevel">第三关</div>
							<div onClick="SelectModal(4)" class="SmallLevel">第四关</div>
							<div onClick="SelectModal(5)" class="SmallLevel">第五关</div>
							<div onClick="SelectModal(6)" class="SmallLevel">第六关</div>
							<div onClick="SelectModal(7)" class="SmallLevel">第七关</div>
							<div onClick="SelectModal(8)" class="SmallLevel">第八关</div>
							<div onClick="SelectModal(9)" class="SmallLevel">第九关</div>
							<div onClick="SelectModal(10)" class="SmallLevel">第十关</div>
						</div>
						<div id="dBigLvl2" style="display:none">
							<div class="BigLevel"><span style="cursor:pointer" onClick="SetNone($('dBigLvl2'));SetBlock($('dBigLvl1'))" title="点击进入到第一大关"><<</span>&nbsp;&nbsp;&nbsp;第二大关&nbsp;&nbsp;&nbsp;</div>
							<div onClick="SelectModal(11)" class="SmallLevel">第一关</div>
							<div onClick="SelectModal(12)" class="SmallLevel">第二关</div>
						</div>
					</div>
					<div id="dMiniSmallContainer" class="TitleSmallContainer" style="display:none">
						<div class="BigLevel">小游戏模式</div>
						<div onClick="SelectModal('StrongLevel')" class="SmallLevel" style="width:100%">超乎寻常的压力！</div>
						<div onClick="SelectModal('TestUHeart')" class="SmallLevel" style="width:100%">你的心脏够强劲吗？</div>
						<div onClick="SelectModal('ZombieRun')" class="SmallLevel" style="width:100%">僵尸快跑！</div>
						<div onClick="SelectModal('PovertyOfTheSoil')" class="SmallLevel" style="width:100%">贫瘠之地</div>
						<div onClick="SelectModal('MassGrave')" class="SmallLevel" style="width:100%">乱葬岗</div>
					</div>
				</div>
				<div class="OptionsMenuButton" style="margin-top:20px" onMouseDown="OptionsMenuDown(this,$('sLevelMenu'))" onMouseUp="OptionsMenuUP(this,$('sLevelMenu'));HiddenLevel();HiddenMiniGame()"><span id="sLevelMenu" class="OptionsMenuButtonSpan">返&nbsp;&nbsp;&nbsp;&nbsp;回</span></div>
			</div>
		</div>
	</div>
</div>

<!--主界面EDAll-->
<div class="WindowFrame" id="dAll" style="position:absolute;left:0;top:0;width:900px;background-color:#000">
	<!--背景图片-->
	<div style="position:absolute;width:1400px;height:600px;display:none;z-index:0" id="tGround"></div>
	<!--左边卡片列-->
	<div id="dCardList" style="visibility:hidden;position:absolute;left:500px;top:0;width:100px;overflow:visible;z-index:254"></div>
	<!--出场僵尸显示-->
	<div id="dZombie" style="position:absolute;width:335px;height:600px;left:1065px;top:0;z-index:1"></div>
	<!--选择卡片-->
	<div id="dSelectCard" align=center style="display:none;position:absolute;left:600px;top:0;width:465px;height:600px;z-index:1;background: url('images/corpse/interface/SeedChooser_Background.png') no-repeat">
		<div style="text-align:center;line-height:35px;font-size: 12pt;color:#FC6;height:35px;width:100%;top:0;font-family:新宋体;font-weight: bold">选择你的植物</div>
		<div id="dPCard" style="position:relative;width:96%;height:455px;"></div>
		<div style="width:100%;height:40px;line-height:40px;text-align:center;margin-top:10px">
			<input onClick="ResetSelectCard()" type="button" value="重选" name="btnReset" id="btnReset" style="width: 65; height: 35; border-left: 3px solid #85411C; border-right: 3px solid #4E250C; border-top: 3px solid #85411C; border-bottom: 3px solid #4E250C; background-color: #602D11; color:#FC6; font-weight:bold; font-size:14px;cursor:pointer">
			<input onClick="LetsGO()" type="button" value="GO!" disabled="disabled" name="btnOK" id="btnOK" style="width: 65; height: 35; border-left: 3px solid #85411C; border-right: 3px solid #4E250C; border-top: 3px solid #85411C; border-bottom: 3px solid #4E250C; background-color: #602D11; color:#888; font-weight:bold; font-size:14px;cursor:pointer">
		</div>
	</div>
	<!--阳光和铲子-->
	<div id="dTop" style="position:absolute;left:605px;top:561px;height:35px;width:123px;display:none;z-index:1;">
		<div id="dSunNum" style="background:url('images/corpse/interface/SunBack.png') no-repeat;position:absolute;width:123px;height:35px"><span id="sSunNum" style="text-align:center;position:absolute;top:4px;left:43px;width:68px;font-family:Verdana;font-weight:bold;font-size:18pt"></span></div>
		<div id="tdShovel" style="position:absolute;width:71px;height:35px;left:130px;background: url('images/corpse/interface/ShovelBack.png') no-repeat;visibility:hidden"><img id="imgShovel" src="images/corpse/interface/Shovel.png" onMouseDown="ChoseShovel(event)"></div>
	</div>
</div>

<!--菜单-->
<div id="dMenu" style="display:none;position:absolute;cursor:pointer;width:226px;height:41px;left:677px;z-index:254">
	<div id="dMenu0" class="Menu" onClick="PauseGame(this)">暂 停</div>
	<div id="dMenu1" class="Menu" onClick="ClickMenu()">菜 单</div>
</div>

<!--图鉴-->
<div id="dHandBook" style="display:none;position:absolute;z-index:255" class="WindowFrame">
<table border="0" width="800" cellspacing="0" cellpadding="0" background="images/corpse/interface/Almanac_IndexBack.jpg" height="600">
	<tr>
		<td height="88" align="center" style="font-size: 32px; font-weight: bold; font-family: 黑体;" colspan="3">	图鉴——索引</td>
	</tr>
	<tr>
		<td align="center" width="400" height="473">
		<img border="0" src="images/corpse/Plants/SunFlower/SunFlower.gif" width="73" height="74"><br>
		<br>
		<br>
		<br>
		<input type="button" value="查看植物" name="btnViewPlant" id="btnViewPlant" style="cursor:pointer;width: 113; height: 41; border-left: 3px solid #85411C; border-right: 3px solid #4E250C; border-top: 3px solid #85411C; border-bottom: 3px solid #4E250C; background-color: #8F431B; color:#FFCC66; font-weight:bold; font-size:14pt; font-family:幼圆" onClick="ViewProducePlant()"><br>
		<br>
&nbsp;</td>
		<td align="center" width="400" height="473" colspan="2">
		<img border="0" src="images/corpse/Zombies/Zombie/Zombie.gif" width="149" height="130"><br>
&nbsp;<table border="0" width="113" background="images/corpse/interface/Button.png" height="41" cellspacing="0" cellpadding="0">
			<tr>
				<td style="cursor:pointer;font-weight:bold; font-size:14pt; font-family:幼圆; color:#00F500" align="center" onClick="ViewProduceZombie()">查看僵尸</td>
			</tr>
		</table>
		<p><br>
		<br>
&nbsp;</td>
	</tr>
	<tr>
		<td align="center" width="400">
		　</td>
		<td align="center" width="238">
		　</td>
		<td align="center" width="162">
		<table border="0" width="89" cellspacing="0" cellpadding="0" height="26">
			<tr>
				<td background="images/interface/Almanac_CloseButton.png" style="cursor:pointer" onMouseOver="this.style.backgroundImage='url(images/interface/Almanac_CloseButtonHighlight.png)'" onMouseOut="this.style.backgroundImage='url(images/interface/Almanac_CloseButton.png)'" onClick="SetNone($('dHandBook'))" align="center">
				<font color="#000080" style="font-size: 9pt;">关闭</font></td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</div>

<!--获得新植物-->
<div id="dNewPlant" style="display:none;position:absolute;width:800px;height:600px;background:url(/images/corpse/interface/AwardScreen_Back.jpg) no-repeat">
	<div id="dNewPlantTitle" style="position:absolute;left:50%;text-align:center;margin-left:-250px;color: #FC6; font-size: 20px;height:90px;line-height:90px; font-weight: bold; width:500px">你获得了一棵新的植物！</div>
	<div style="position:absolute;top:100px;width:800px;height:191px;line-height:191px;text-align:center">
		<img id="iNewPlantCard" border="0">
	</div>
	<br>
	<div id="dNewPlantName" style="position:absolute;position:absolute;top:291px;text-align:center;left:50%;margin-left:-150px;width:300px;height:55px;font-family: 宋体; font-size: 20px; color: #FC6; font-weight: bold;line-height:55px">abc</div>
	<br><br><br>
	<div id="dNewPlantTooltip" style="position:absolute;left:50%;top:400px;text-align:center;margin-left:-140px;width:280px;font-weight: bold;font-family: 宋体; font-size: 12px;color:#232323">abc</div>
	<br><br><br><br><br><br>
	<input type="button" value="下一关！" name="btnNextLevel" id="btnNextLevel" style="position:absolute;cursor:pointer;width: 113; height: 41; border-left: 3px solid #85411C; border-right: 3px solid #4E250C; border-top: 3px solid #85411C; border-bottom: 3px solid #4E250C; background-color: #8F431B; color:#FC6; font-weight:bold; font-size:14px; font-family:幼圆; left:344; top:507">
</div>
<script type="text/javascript">
//初始化系统对象，载入关卡
LoadLvl();

</script>
