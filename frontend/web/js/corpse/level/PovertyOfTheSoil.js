oS.Init({
	PName: [oPeashooter, oSunFlower, oCherryBomb, oWallNut, oPotatoMine, oSnowPea, oChomper, oSplitPea, oJalapeno, oSpikeweed, oRepeater, oTallNut, oPumpkinHead, oSquash, oFlowerPot, oTorchwood, oThreepeater, oGatlingPea, oTwinSunflower, oSpikerock, oFumeShroom, oCoffeeBean, oGloomShroom, oSunShroom, oPuffShroom, oScaredyShroom, oGarlic],
	ZName: [oZombie, oConeheadZombie, oPoleVaultingZombie, oBucketheadZombie],
	PicArr: ["images/corpse/interface/background1unsodded2.jpg", "images/corpse/interface/ZombieNoteSmall.png"],
	backgroundImage: "images/corpse/interface/background1unsodded2.jpg",
	CanSelectCard: 1,
	SunNum: 150,
	LF: [0, 0, 1, 1, 1, 0],
	ZF: [0, 1, 1, 1, 1, 1],
	LevelName: "小游戏：贫瘠之地",
	LargeWaveFlag: {
		10: $("imgFlag3"),
		20: $("imgFlag2"),
		30: $("imgFlag1")
	},
	LoadMusic: function() {
		NewEle("oEmbed", "embed", "width:0;height:0", {
			src: "music/Look up at the.swf"
		}, EDAll)
	}
}, {
	ArZ: [oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oConeheadZombie, oConeheadZombie, oPoleVaultingZombie, oBucketheadZombie],
	FlagNum: 30,
	SumToZombie: {
		1: 6,
		2: 9,
		3: 10,
		"default": 10
	},
	FlagToSumNum: {
		a1: [3, 5, 9, 10, 13, 15, 19, 20, 23, 25, 29],
		a2: [1, 2, 3, 10, 4, 5, 6, 15, 7, 8, 9, 25]
	},
	FlagToMonitor: {
		9: [ShowLargeWave, 0],
		19: [ShowLargeWave, 0],
		29: [ShowFinalWave, 0]
	},
	FlagToEnd: function() {
		NewImg("imgSF", "images/corpse/interface/trophy.png", "left:667px;top:220px", EDAll, {
			onclick: function() {
				SelectModal(0)
			}
		});
		NewImg("PointerUD", "images/corpse/interface/PointerDown.gif", "top:185px;left:676px", EDAll)
	}
});