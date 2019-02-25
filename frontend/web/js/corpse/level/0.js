oS.Init({
	PicArr: function() {
		var a = $User.Browser.IE6 ? 8 : 32;
		return [ShadowPNG,
			"images/corpse/Sun.gif",
			"images/corpse/OptionsMenuback" + a + ".png",
			"images/corpse/OptionsBackButton" + a + ".png",
			"images/corpse/Surface.png",
			"images/corpse/Help.png",
			"images/corpse/SelectorScreenStartAdventur.png",
			"images/corpse/SelectorScreenSurvival.png",
			"images/corpse/Logo.jpg",
			"images/corpse/LawnMower.gif??images/corpse/ZombiesWon.png??images/corpse/LargeWave.gif??images/corpse/FinalWave.gif??images/corpse/PrepareGrowPlants.gif",
			"images/corpse/interface/PointerUP.gif??images/corpse/interface/PointerDown.gif??images/corpse/interface/Shovel.png??images/corpse/interface/SunBack.png",
			"images/corpse/interface/ShovelBack.png??images/corpse/interface/GrowSoil.png??images/corpse/interface/SeedChooser_Background.png??images/corpse/interface/Button.png",
			"images/corpse/interface/LogoLine.png??images/corpse/interface/dialog_topleft.png??images/corpse/interface/dialog_topmiddle.png??images/corpse/interface/dialog_topright.png",
			"images/corpse/interface/dialog_centerleft.png??images/corpse/interface/dialog_centermiddle.png??images/corpse/interface/dialog_centerright.png??images/corpse/interface/SelectorScreen_Almanac.png",
			"images/corpse/interface/SelectorScreen_AlmanacHighlight.png??images/corpse/interface/dialog_bottomleft.png??images/corpse/interface/dialog_bottommiddle.png",
			"images/corpse/interface/dialog_bottomright.png??images/corpse/interface/Almanac_IndexBack.jpg??images/corpse/interface/Almanac_IndexButton.png??images/corpse/interface/Almanac_CloseButton.png",
			"images/corpse/interface/Almanac_CloseButtonHighlight.png??images/corpse/interface/Almanac_IndexButtonHighlight.png??images/corpse/interface/Almanac_PlantBack.jpg??images/corpse/interface/Almanac_PlantCard.png",
			"images/corpse/interface/Almanac_ZombieBack.jpg??images/corpse/interface/Almanac_ZombieCard.png??images/corpse/interface/AwardScreen_Back.jpg"]
	}(),
	LevelName: "JSPVZ",
	LoadMusic: function() {
		NewEle("oEmbed", "embed", "width:0;height:0", {
			src: "sounds/corpse/Faster.swf"
		}, EDAll)
	},
	LoadAccess: function() {
		EDAll.scrollLeft = 0;
		EDAll.innerHTML += WordUTF8;
		LoadProProcess();
		oSym.Stop()
	}
});