oS.Init({
	PName: [oPeashooter, oPotatoMine, oSquash, oCherryBomb, oJalapeno],
	ZName: [oZombie],
	PicArr: ["images/corpse/interface/background1.jpg"],
	backgroundImage: "images/corpse/interface/background1.jpg",
	CanSelectCard: 0,
	SunNum: 100,
	LevelName: "小游戏：你的心脏够强劲吗？",
	LargeWaveFlag: {
		1: $("imgFlag1")
	},
	LoadMusic: function() {
		NewEle("oEmbed", "embed", "width:0;height:0", {
			src: "music/Look up at the.swf"
		}, EDAll)
	},
	StartGame: function() {
		SetVisible($("tdShovel"), $("dFlagMeter"));
		SetBlock($("dTop"));
		var a = NewEle("DivTeach", "div", "line-height:40px;font-size: 14px", 0, EDAll);
		NewEle("spanT", "span", "position:absolute;left:0;width:500px;text-align: center; font-family: 幼圆; font-size: 14px;line-height:50px", 0, a);
		NewEle("btnClick1", "span", "cursor:pointer;position:absolute;left:510px;height:40px;width:50px;text-align:center;line-height:40px;font-family: 幼圆; font-size: 14px;color:#FFF;border:1px solid #888;background:#000", 0, a);
		NewEle("btnClick2", "span", "cursor:pointer;position:absolute;left:580px;height:40px;width:100px;text-align:center;line-height:40px;font-family: 幼圆; font-size: 14px;color:#FFF;border:1px solid #888;background:#000", 0, a);
		NewEle("btnClick3", "span", "cursor:pointer;position:absolute;left:700px;height:40px;width:200px;text-align:center;line-height:40px;font-family: 幼圆; font-size: 14px;color:#FFF;border:1px solid #888;background:#000", 0, a);
		innerText($("spanT"), "想测试一下你的CPU和浏览器足够强劲吗？打开任务管理器，点击开始吧！");
		innerText($("btnClick1"), "100个");
		innerText($("btnClick2"), "1000个僵尸！");
		innerText($("btnClick3"), "给我来5000个僵尸吧！！");
		oP.Monitor({
			ar: [0],
			f: function() {
				var b = function() {
						ClearChild($("oEmbed"));
						NewEle("oEmbed", "embed", "width:0;height:0", {
							src: "music/Watery Graves.swf"
						}, EDAll);
						oS.InitLawnMower();
						PrepareGrowPlants(function() {
							BeginCool();
							AutoProduceSun(25);
							oP.AddZombiesFlag();
							SetVisible($("dFlagMeterContent"))
						})
					};
				$("btnClick1").onclick = function() {
					oP.FlagToSumNum.a2 = [100];
					innerText($("DivTeach"), "下面有请我们的100个僵尸客串演员出场！");
					b()
				};
				$("btnClick2").onclick = function() {
					oP.FlagToSumNum.a2 = [1000];
					innerText($("DivTeach"), "下面有请我们的1000个僵尸客串演员出场！");
					b()
				};
				$("btnClick3").onclick = function() {
					oP.FlagToSumNum.a2 = [5000];
					innerText($("DivTeach"), "有请5000个客串演员出场！！或许他们化妆需要一点时间，请耐心等待。。。");
					b()
				}
			}
		});
		SetBlock($("dFlagMeter"));
		CustomPlants(0, 2, 5);
		CustomPlants(0, 3, 9);
		CustomPlants(0, 4, 1)
	}
}, {
	ArZ: [oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie, oZombie],
	FlagNum: 1,
	SumToZombie: {
		1: 30,
		"default": 30
	},
	FlagToSumNum: {
		a1: [],
		a2: [1000]
	},
	FlagToMonitor: {
		1: [ShowFinalWave, 0]
	},
	FlagToEnd: function() {
		NewImg("imgSF", "images/corpse/interface/trophy.png", "left:260px;top:233px", EDAll, {
			onclick: function() {
				SelectModal(0)
			}
		});
		NewImg("PointerUD", "images/corpse/interface/PointerDown.gif", "top:198px;left:269px", EDAll)
	}
});