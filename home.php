<?php
include_once 'config.php';
?>

<!doctype html>
<html class="no-js" lang="">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="manifest" href="site.webmanifest">
        <link rel="apple-touch-icon" href="icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/jquery.fancybox.min.css">
        <link rel="stylesheet" type="text/css" href="css/fontawesome-all.css">
        <link href="css/jquery.contextMenu.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/styles.css">
    </head>

    <body>
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            style="display: none;">
            <symbol class="wave" id="wave">
                <path
                    d="M420,20c21.5-0.4,38.8-2.5,51.1-4.5c13.4-2.2,26.5-5.2,27.3-5.4C514,6.5,518,4.7,528.5,2.7c7.1-1.3,17.9-2.8,31.5-2.7c0,0,0,0,0,0v20H420z">
                </path>
                <path
                    d="M420,20c-21.5-0.4-38.8-2.5-51.1-4.5c-13.4-2.2-26.5-5.2-27.3-5.4C326,6.5,322,4.7,311.5,2.7C304.3,1.4,293.6-0.1,280,0c0,0,0,0,0,0v20H420z">
                </path>
                <path
                    d="M140,20c21.5-0.4,38.8-2.5,51.1-4.5c13.4-2.2,26.5-5.2,27.3-5.4C234,6.5,238,4.7,248.5,2.7c7.1-1.3,17.9-2.8,31.5-2.7c0,0,0,0,0,0v20H140z">
                </path>
                <path
                    d="M140,20c-21.5-0.4-38.8-2.5-51.1-4.5c-13.4-2.2-26.5-5.2-27.3-5.4C46,6.5,42,4.7,31.5,2.7C24.3,1.4,13.6-0.1,0,0c0,0,0,0,0,0l0,20H140z">
                </path>
            </symbol>
        </svg>

        <div class="main-contain-wrapper">
            <div class="main-container">
                <div class="component-wrapper br" id="start-panel">
                    <div class="component-container">
                        <h3>Oil Refining</h3>
                        <div class="status-bar">
                            <div id="I_001" class="status">Stopped </div>
                            <div class="step">Step 0 </div>
                        </div>
                        <div class="path-wrapper">
                            <span id="I_003" class="path br">No Path</span>
                            <span id="path_indicator" class="path-indicator br"></span>
                        </div>
                        <div class="button-secton">
                            <button id="B_001" class="deactivated button br"><span class="icon"><img
                                        src="img/start_icon.png" alt="start"></span> Start</button>
                            <button id="B_002" class="deactivated button br"><span class="icon"><img
                                        src="img/sut-d_icon.png" alt="Shutdown"></span> Shutdown</button>
                            <button id="B_003" class="deactivated button br"><span class="icon"><img
                                        src="img/pause_icon.png" alt="pause"></span> Pause</button>
                            <!-- <button class="button br btn" data-fancybox data-src="#animatedModal" ><span class="icon"><img src="img/settings.png" alt="Settings"></span> Settings</button> -->
                            <button class="button br btn chart-btn" type="button" data-fancybox data-type="inline"
                                data-src="#dataChart" data-options='{"touch":false}'><span class="icon"><img
                                        src="img/chart-btn.png" alt="Settings"></span></button>
                        </div>
                        <div class="pop-up-window" id="animatedModal">
                            <h2>Hello!</h2>
                            <p>Add Settings here</p>
                        </div>
                    </div>
                </div>

                <div class="component-wrapper br" id="settings-panel">
                    <div class="component-container">
                        <div class="button-section">
                            <button class="button br btn" data-fancybox data-src="#productionSetting"><span
                                    class="icon"><img src="img/settings.png" alt="Settings"></span> Production
                                Settings</button>
                            <!-- <button class="button br btn" data-fancybox data-src="#tankFarm" >Tank Farm</button> -->
                        </div>
                        <div id="time_display" class="time"></div>
                        <div class="alarms"><span> Alarms:</span> <span id="alarm_msg" class="alarm-set br"></span>
                        </div>
                        <div class="event-list step-methord">
                            E
                        </div>
                        <div class="time-list step-methord">
                            T
                        </div>
                        <div class="steps">
                            <span class="step-b"><i id="pro_back" class="fas fa-angle-left"></i></span>
                            <span class="step-f"><i id="pro_fwd" class="fas fa-angle-right"></i></span>
                        </div>
                        <div id="pro_speed" class="step-name">
                            X 1
                        </div>
                        <!--production settings-->
                        <div class="pop-up-window" id="productionSetting">
                            <div class="info-box">
                                <h2>Chemical Dosing Settings</h2>
                                <ul>
                                    <li><label>Phosphoric Acid Dosing(%)</label><input type="text" name=""
                                            id="TK201_DS" /></li>
                                    <li><label>Caustic Dosing(%)</label><input type="text" name="" id="TK202_DS" /></li>
                                    <li><label>Water Dosing(%)</label><input type="text" name="" id="TK203_DS" /></li>
                                </ul>
                            </div>

                            <div class="info-box">
                                <h2>Crude Oil Analysis Parameters</h2>
                                <ul>
                                    <li><label>FFA(%)</label><input type="text" name="" id="FFA" /></li>
                                    <li><label>Temperature(T1)</label><input type="text" name="" id="T201" /></li>
                                </ul>
                            </div>
                            <button id="production_setting">Save</button>
                        </div>
                        <!--end production settings-->
                        <div class="pop-up-window" id="tankFarm">
                            <h1>Tank Farm settings here</h1>
                            <p>add anny HTML here</p>
                        </div>
                    </div>
                </div>

                <div class="component-wrapper br" id="step-1">
                    <div class="component-container">
                        <img src="img/pips/pi-cw-1.svg" alt="pi-cw-1" class="svg pipe pi-cw-1" id="pi-cw-1">
                        <img src="img/pips/feed-cooler.svg" alt="feed-cooler" class="svg pipe feed-cooler"
                            id="feed-cooler">
                        <img src="img/pips/pi-cw-2.svg" alt="pi-cw-2" class="svg pipe pi-cw-2" id="pi-cw-2">
                        <img src="img/elements/3side-valve-right.svg" alt="pv-203" class="svg val pv-203" id="pv-203">
                        <img src="img/pips/pi-o-2.svg" alt="pi-o-2" class="svg pipe pi-o-2" id="pi-o-2">
                        <img src="img/pips/pi-o-3.svg" alt="pi-o-3" class="svg pipe pi-o-3" id="pi-o-3">
                        <img src="img/elements/4side-valve-right.svg" alt="v-201" class="svg val v-201" id="v-201">
                        <img src="img/elements/4side-valve-left.svg" alt="v-202" class="svg val v-202" id="v-202">
                        <img src="img/pips/pi-o-1.svg" alt="pi-o-1" class="svg pipe pi-o-1" id="pi-o-1">
                        <img src="img/sensor-1.png" alt="sensor-1" class="sensor-1" id="sensor-1">
                        <img src="img/pips/pi-o-4.svg" alt="pi-o-4" class="svg pipe pi-o-4" id="pi-o-4">
                        <img src="img/pips/pi-o-5.svg" alt="pi-o-5" class="svg pipe pi-o-5" id="pi-o-5">
                        <img src="img/pips/pi-o-6.svg" alt="pi-o-6" class="svg pipe pi-o-6" id="pi-o-6">
                        <img src="img/pips/feed-cooler.svg" alt="feed-heater" class="svg pipe feed-heater"
                            id="feed-heater">
                        <img src="img/pips/pi-s-2.svg" alt="pi-s-2" class="svg pipe pi-s-2" id="pi-s-2">
                        <img src="img/pips/pi-s-1.svg" alt="pi-s-1" class="svg pipe pi-s-1" id="pi-s-1">
                        <img src="img/elements/3side-valve-right.svg" alt="pv-204" class="svg val pv-204" id="pv-204">
                        <img src="img/pips/dash-cros.svg" alt="dash-cros" class="svg val dash-cros" id="dash-cros">
                        <img src="img/pips/t-201-dashed-border.svg" alt="t-201-dashed" class="svg val t-201-dashed"
                            id="t-201-dashed">
                        <img src="img/elements/moter-vertical.svg" alt="m-201" class="svg m-201" id="m-201">
                        <img src="img/elements/mix2.png" alt="mix-201" class="mix-201" id="mix-201">
                        <button id="btn_cooling" class="btn cooling">Cooling</button>
                        <button id="btn_heating" class="btn heating">Heating</button>
                        <div id="t-201-menu" class="tool-tip tooltip-t201 context-menu-one">
                            <span id="T201_OP"></span>
                            <span id="T201_SP"></span>
                        </div>
                        <span class="label-1 name-label">Cooling water</span>
                        <span class="label-2 name-label">Feed Cooler</span>
                        <span class="label-3 name-label">Crude Oil Feed (F1)</span>
                        <span class="label-4 name-label">PV203</span>
                        <span class="label-5 name-label">V201</span>
                        <span class="label-6 name-label">V202</span>
                        <span class="label-7 name-label">T201</span>
                        <span class="label-8 name-label">F201</span>
                        <span class="label-9 name-label">Steam</span>
                        <span class="label-10 name-label">Feed Heater</span>
                        <span class="label-58 name-label">Crude oil sensor</span>

                        <img src="img/direction.gif" alt="direction" class="direction ar-1">
                        <img src="img/direction.gif" alt="direction" class="direction ar-2">
                        <img src="img/direction.gif" alt="direction" class="direction ar-3">
                    </div>
                </div>

                <div class="component-wrapper br" id="step-2">
                    <div class="component-container">
                        <img src="img/pips/pi-a-1.svg" alt="pi-a-1" class="svg pipe pi-a-1" id="pi-a-1">
                        <img src="img/elements/pump.svg" alt="p-201" class="svg pipe p-201" id="p-201">
                        <img src="img/pips/p-201-pump-bottom-pipe.svg" alt="p-201-pump-bottom-pipe"
                            class="svg pipe p-201-pump-bottom-pipe" id="p-201-pump-bottom-pipe">
                        <div class="tank tk-201" id="tk-201">
                            <div class="percent">
                                <div class="percentNum" id="count">0</div>
                                <div class="percentB">%</div>
                            </div>
                            <div id="water" class="water">
                                <svg viewBox="0 0 560 20" class="water_wave water_wave_back">
                                    <use xlink:href="#wave"></use>
                                </svg>
                                <svg viewBox="0 0 560 20" class="water_wave water_wave_front">
                                    <use xlink:href="#wave"></use>
                                </svg>
                            </div>
                        </div>
                        <div id="hls-201" class="macker macker-right hls-201">HSL 201</div>
                        <div id="lls-201" class="macker macker-right lls-201">LLS 201</div>
                        <div id="llls-201" class="macker macker-right llls-201">LLLs 201</div>
                        <div class="tool-tip tooltip-2" id="oil_flow_rate">
                            <span id="F201_OP"></span>
                            <span id="F201_SP"></span>
                        </div>
                    </div>
                    <div class="tool-tip tooltip-8">
                        <span id="acid_val"></span>
                    </div>
                    <div class="tool-tip tooltip-9">
                        <span id="caustic_val"></span>
                    </div>
                    <span class="label-11 name-label">M201</span>
                    <span class="label-12 name-label">Acid Tank Agitator</span>
                    <span class="label-13 name-label">TK201</span>
                    <span class="label-14 name-label">Acid%</span>
                    <span class="label-15 name-label">Acid Solution Tank </span>
                    <span class="label-16 name-label">PV204</span>
                    <span class="label-17 name-label">P201</span>
                    <span class="label-18 name-label">Acid metering pump </span>

                    <img src="img/direction.gif" alt="direction" class="direction ar-4">
                    <img src="img/direction.gif" alt="direction" class="direction ar-5">
                </div>

                <div class="component-wrapper br" id="step-3">
                    <div class="component-container">
                        <img src="img/elements/moter-vertical.svg" alt="m-202" class="svg m-202" id="m-202">
                        <img src="img/elements/mix.png" alt="mix-202" class="mix-202" id="mix-202">
                        <img src="img/pips/m-202-bot-pipe.svg" alt="m-202-bot-pipe" class="svg pipe m-202-bot-pipe"
                            id="m-202-bot-pipe">
                        <img src="img/pips/pi-c-1.svg" alt="pi-c-1" class="svg pipe pi-c-1" id="pi-c-1">
                        <img src="img/pips/pi-w-1.svg" alt="pi-w-1" class="svg pipe pi-w-1" id="pi-w-1">
                        <img src="img/elements/pump.svg" alt="p-202" class="svg p-202" id="p-202">
                        <img src="img/pips/p-201-pump-bottom-pipe.svg" alt="p-201-pump-bottom-pipe"
                            class="svg pipe p-201-pump-bottom-pipe" id="p-201-2-pump-bottom-pipe">
                        <img src="img/pips/p-203-stand.svg" alt="p-203-stand" class="svg pipe p-203-stand"
                            id="p-203-stand">
                        <img src="img/elements/moter-horisontal-left.svg" alt="p-203" class="svg p-203" id="p-203">
                        <img src="img/pips/pi-connecter-tank-203.svg" alt="pi-connecter-tank-203"
                            class="svg pipe pi-connecter-tank-203" id="pi-connecter-tank-203">
                        <img src="img/elements/inline-mixer.svg" alt="inline-mixer" class="svg inline-mixer"
                            id="inline-mixer">
                        <img src="img/elements/moter-vertical.svg" alt="m-203" class="svg m-203" id="m-203">
                        <img src="img/elements/mix.png" alt="mix-203" class="mix-203" id="mix-203">
                        <img src="img/pips/pi-o-08.svg" alt="pi-o-08" class="svg pipe pi-o-08" id="pi-o-08">
                        <img src="img/pips/p-203-stand.svg" alt="p-204-stand" class="svg pipe p-204-stand fliph"
                            id="p-204-stand">
                        <img src="img/elements/moter-horisontal-left.svg" alt="p-204" class="svg p-204 fliph"
                            id="p-204">
                        <img src="img/pips/pi-o-09.svg" alt="pi-o-09" class="svg pipe pi-o-09" id="pi-o-09">
                        <img src="img/pips/feed-cooler.svg" alt="sep-heater" class="svg pipe sep-heater"
                            id="sep-heater">
                        <img src="img/pips/pi-s-4.svg" alt="pi-s-4" class="svg pipe pi-s-4" id="pi-s-4">
                        <div class="tool-tip tooltip-3">
                            <span>34%</span>
                            <span>75%</span>
                        </div>
                        <div class="tank tk-202" id="tk-202">
                            <div class="percent">
                                <div class="percentNum" id="count">0</div>
                                <div class="percentB">%</div>
                            </div>
                            <div id="water" class="water">
                                <svg viewBox="0 0 560 20" class="water_wave water_wave_back">
                                    <use xlink:href="#wave"></use>
                                </svg>
                                <svg viewBox="0 0 560 20" class="water_wave water_wave_front">
                                    <use xlink:href="#wave"></use>
                                </svg>
                            </div>
                        </div>
                        <div id="hls-202" class="macker macker-left hls-202">HSL 202</div>
                        <div id="lls-202" class="macker macker-left lls-202">LLS 202</div>
                        <div id="llls-202" class="macker macker-left llls-202">LLLS 202</div>
                        <div class="tank tk-204" id="tk-204">
                            <div class="percent">
                                <div class="percentNum" id="count">0</div>
                                <div class="percentB">%</div>
                            </div>
                            <div id="water" class="water">
                                <svg viewBox="0 0 560 20" class="water_wave water_wave_back">
                                    <use xlink:href="#wave"></use>
                                </svg>
                                <svg viewBox="0 0 560 20" class="water_wave water_wave_front">
                                    <use xlink:href="#wave"></use>
                                </svg>
                            </div>
                        </div>
                        <div id="hls-204" class="macker macker-left hls-204">HLS 204</div>
                        <div id="lls-204" class="macker macker-left lls-204">LLS 204</div>
                        <div class="tank mixer-202" id="mixer-202">
                            <div class="percent">
                                <div class="percentNum" id="count">0</div>
                                <div class="percentB">%</div>
                            </div>
                            <div id="water" class="water">
                                <svg viewBox="0 0 560 20" class="water_wave water_wave_back">
                                    <use xlink:href="#wave"></use>
                                </svg>
                                <svg viewBox="0 0 560 20" class="water_wave water_wave_front">
                                    <use xlink:href="#wave"></use>
                                </svg>
                            </div>
                        </div>
                        <div class="tank tk-203" id="tk-203">
                            <div class="percent">
                                <div class="percentNum" id="count">0</div>
                                <div class="percentB">%</div>
                            </div>
                            <div id="water" class="water">
                                <svg viewBox="0 0 560 20" class="water_wave water_wave_back">
                                    <use xlink:href="#wave"></use>
                                </svg>
                                <svg viewBox="0 0 560 20" class="water_wave water_wave_front">
                                    <use xlink:href="#wave"></use>
                                </svg>
                            </div>
                        </div>
                        <div id="lls-203" class="macker macker-left lls-203">LLS 203</div>
                    </div>
                    <span class="label-19 name-label">Acid Mixer</span>
                    <span class="label-20 name-label">M202</span>
                    <span class="label-21 name-label">Caustic %</span>
                    <span class="label-22 name-label">Caustic metering pump </span>
                    <span class="label-23 name-label">P202</span>
                    <span class="label-24 name-label">In line Mixer</span>
                    <span class="label-25 name-label">Reactor Agitator</span>
                    <span class="label-26 name-label">M203</span>
                    <span class="label-27 name-label">L204</span>
                    <span class="label-28 name-label">Reaction Tank </span>
                    <span class="label-29 name-label">TK204</span>
                    <span class="label-30 name-label">Water Tank: TK203</span>
                    <span class="label-31 name-label">P203</span>
                    <span class="label-32 name-label">Water metering pump </span>
                    <span class="label-33 name-label">P204</span>
                    <span class="label-34 name-label">PV205</span>
                    <span class="label-35 name-label">Steam</span>
                    <span class="label-36 name-label">Separation Heater </span>
                    <span class="label-37 name-label">T202</span>
                    <span class="label-38 name-label">PV206</span>

                    <img src="img/direction.gif" alt="direction" class="direction ar-6">
                    <img src="img/direction.gif" alt="direction" class="direction ar-7">
                    <img src="img/direction.gif" alt="direction" class="direction ar-8">
                    <img src="img/direction.gif" alt="direction" class="direction ar-9">
                </div>

                <div class="component-wrapper br" id="step-4">
                    <div class="component-container">
                        <img src="img/pips/pi-o-10-1.svg" alt="pi-o-10-1" class="svg pipe pi-o-10-1" id="pi-o-10-1">
                        <img src="img/elements/3side-valve-left.svg" alt="pv-206" class="svg val pv-206" id="pv-206">
                        <img src="img/pips/pi-o-10-2.svg" alt="pi-o-10-2" class="svg pipe pi-o-10-2" id="pi-o-10-2">
                        <img src="img/pips/pi-s-1.svg" alt="pi-s-05-1" class="svg pipe pi-s-05-1" id="pi-s-05-1">
                        <img src="img/elements/3side-valve-right.svg" alt="pv-205" class="svg pv-205" id="pv-205">
                        <img src="img/pips/pi-connecter-tank-203.svg" alt="pi-s-05-2" class="svg pipe pi-s-05-2"
                            id="pi-s-05-2">
                        <img src="img/pips/dashed-tip-1.svg" alt="dashed-tip-1" class="svg dashed-tip-1"
                            id="dashed-tip-1">
                        <div class="tool-tip tooltip-4">
                            <span>80.5 &deg;C</span>
                            <span>80.5 &deg;C</span>
                        </div>
                        <img src="img/elements/centrifugal-separator.svg" alt="cs-201" class="svg cs-201" id="cs-201">
                        <img src="img/pips/pi-v-short.svg" alt="pi-water-1" class="svg pipe pi-water-1" id="pi-water-1">
                        <img src="img/pips/pi-v-short.svg" alt="pi-water-2" class="svg pipe pi-water-2" id="pi-water-2">
                        <img src="img/elements/3side-valve-right.svg" alt="pv-208" class="svg pv-208" id="pv-208">
                        <img src="img/pips/pi-h-short.svg" alt="ro-pv-1" class="svg ro-pv-1" id="ro-pv-1">
                        <img src="img/sensor-1.png" alt="sensor-2" class="sensor-2" id="sensor-2">
                        <img src="img/pips/pi-h-short.svg" alt="ro-pv-2" class="svg ro-pv-2" id="ro-pv-2">
                        <img src="img/elements/3side-valve-top.svg" alt="pv-209" class="svg pv-209" id="pv-209">
                        <img src="img/elements/4side-valve-right.svg" alt="pv-207" class="svg pv-207" id="pv-207">
                        <img src="img/pips/pi-v-short.svg" alt="pi-o-10" class="svg pi-o-10" id="pi-o-10">
                        <img src="img/pips/pi-v-short.svg" alt="pi-o-11" class="svg pi-o-11" id="pi-o-11">
                        <img src="img/pips/pi-hp-1.svg" alt="pi-hp-1" class="svg pi-hp-1" id="pi-hp-1">
                        <img src="img/pips/pi-e-2.svg" alt="pi-e-2" class="svg pi-e-2" id="pi-e-2">
                        <img src="img/pips/pi-v-short.svg" alt="pi-p-205" class="svg pi-p-205" id="pi-p-205">
                        <img src="img/pips/p-203-stand.svg" alt="p-205-stand" class="svg pipe p-205-stand fliph"
                            id="p-205-stand">
                        <img src="img/elements/moter-horisontal-left.svg" alt="p-205 " class="svg p-205 fliph"
                            id="p-205">
                        <img src="img/pips/pi-h-short.svg" alt="pi-hp-2" class="svg pi-hp-2" id="pi-hp-2">
                        <img src="img/elements/moter-vertical.svg" alt="m-205" class="svg m-205" id="m-205">
                        <img src="img/elements/mix.png" alt="mix-205" class="mix-205" id="mix-205">
                        <div class="tank tk-205" id="tk-205">
                            <div class="percent">
                                <div class="percentNum" id="count">0</div>
                                <div class="percentB">%</div>
                            </div>
                            <div id="water" class="water">
                                <svg viewBox="0 0 560 20" class="water_wave water_wave_back">
                                    <use xlink:href="#wave"></use>
                                </svg>
                                <svg viewBox="0 0 560 20" class="water_wave water_wave_front">
                                    <use xlink:href="#wave"></use>
                                </svg>
                            </div>
                        </div>
                        <div id="hls-205" class="macker macker-right hls-205">HLS 205</div>
                        <div id="lls-205" class="macker macker-right lls-205">LLS 205</div>
                    </div>
                    <div class="tool-tip tooltip-10">
                        <span>50%</span>
                        <span>60%</span>
                    </div>
                    <span class="label-39 name-label">Water</span>
                    <span class="label-40 name-label">PV208</span>
                    <span class="label-41 name-label">Tank Farm</span>
                    <span class="label-42 name-label">PV209</span>
                    <span class="label-43 name-label">PI-O-10</span>
                    <span class="label-44 name-label">PV207</span>
                    <span class="label-45 name-label">Centrifugal Separator</span>
                    <span class="label-46 name-label">Soap and gums</span>
                    <span class="label-47 name-label">CS201</span>
                    <span class="label-48 name-label">Ejection flush</span>
                    <span class="label-49 name-label">PI-O-011</span>
                    <span class="label-50 name-label">Drying</span>
                    <span class="label-51 name-label">M205</span>
                    <span class="label-52 name-label">Heavy Phase Agitator</span>
                    <span class="label-53 name-label">L205</span>
                    <span class="label-54 name-label">Heavy Phase Tank</span>
                    <span class="label-55 name-label">TK205</span>
                    <span class="label-56 name-label">P205</span>
                    <span class="label-57 name-label">Heavy phase pump</span>
                    <span class="label-59 name-label">Refined oil sensor</span>

                    <img src="img/direction.gif" alt="direction" class="direction ar-10">
                    <img src="img/direction.gif" alt="direction" class="direction ar-11">
                    <img src="img/direction.gif" alt="direction" class="direction ar-12">
                    <img src="img/direction.gif" alt="direction" class="direction ar-13">
                    <img src="img/direction.gif" alt="direction" class="direction ar-14">
                    <img src="img/direction.gif" alt="direction" class="direction ar-15">
                </div>
                <!--            <button id="acton-btn">run</button>
                        <button id="reset-btn">reset</button>-->

                <a class="button br btn log-out" href="<?php echo base_url . 'index.php?logout=true' ?>">Log out</a>
                <div class="separator info-box">
                    <h2>Separator</h2>
                    <div id="separator" class='info-box'>
                        <div class='field'><input type="checkbox" name="on" value="on" id='separator_status'><label
                                for="on"> On</label><span id="sep_time"></span></div>
                        <div class='field'>
                            <input disabled checked type="radio" name="separator_opt" value="PR" id="product"><label
                                for="product"> Product</label><br>
                            <input disabled type="radio" name="separator_opt" value="PE" id="partialej"><label
                                for="partialej"> Partial Ej</label><br>
                            <input disabled type="radio" name="separator_opt" value="TE" id="totalej"><label
                                for="totalej"> Total Ej</label><br>
                            <input disabled type="radio" name="separator_opt" value="CP" id='cip'><label for="cip">
                                CIP</label><br>
                            <input disabled type="radio" name="separator_opt" value="WR" id='water'><label for="water">
                                Water</label><br>
                        </div>
                    </div>
                </div>

                <div class="pop-up-window oil-trends-modal" id="dataChart">
                    <div class="oil-trends-inner">
                        <header class="oil-trends-header">
                            <h2 class="oil-trends-title">Crude Oil and Refined Oil Trends</h2>
                        </header>
                        <div class="oil-trends-toolbar">
                            <span class="oil-trends-toolbar-label">Time Span</span>
                            <div class="oil-trends-seg" role="group" aria-label="Time span">
                                <button type="button" class="oil-trends-seg-btn" data-span="1h">1H</button>
                                <button type="button" class="oil-trends-seg-btn is-active" data-span="8h">8H</button>
                                <button type="button" class="oil-trends-seg-btn" data-span="24h">24H</button>
                                <button type="button" class="oil-trends-seg-btn" data-span="7d">7D</button>
                            </div>
                        </div>
                        <div class="oil-trends-chart-wrap">
                            <canvas id="myChart"></canvas>
                        </div>
                        <div class="oil-trends-legend" id="oilTrendsLegend">
                            <div class="oil-trends-legend-row" data-series="0">
                                <span class="oil-trends-swatch oil-trends-swatch--crude"></span>
                                <span class="oil-trends-legend-name">Crude-Oil FFA</span>
                                <span class="oil-trends-legend-value oil-trends-legend-value--crude"
                                    id="oilTrendsVal0">—</span>
                                <div class="oil-trends-spark"><canvas id="oilTrendsSpark0"></canvas></div>
                            </div>
                            <div class="oil-trends-legend-row" data-series="1">
                                <span class="oil-trends-swatch oil-trends-swatch--rffa"></span>
                                <span class="oil-trends-legend-name">Refined Oil FFA</span>
                                <span class="oil-trends-legend-value oil-trends-legend-value--rffa"
                                    id="oilTrendsVal1">—</span>
                                <div class="oil-trends-spark"><canvas id="oilTrendsSpark1"></canvas></div>
                            </div>
                            <div class="oil-trends-legend-row" data-series="2">
                                <span class="oil-trends-swatch oil-trends-swatch--soaps"></span>
                                <span class="oil-trends-legend-name">Refined Oil Soaps</span>
                                <span class="oil-trends-legend-value oil-trends-legend-value--soaps"
                                    id="oilTrendsVal2">—</span>
                                <div class="oil-trends-spark"><canvas id="oilTrendsSpark2"></canvas></div>
                            </div>
                            <div class="oil-trends-legend-row" data-series="3">
                                <span class="oil-trends-swatch oil-trends-swatch--moist"></span>
                                <span class="oil-trends-legend-name">Refined Oil Moisture</span>
                                <span class="oil-trends-legend-value oil-trends-legend-value--moist"
                                    id="oilTrendsVal3">—</span>
                                <div class="oil-trends-spark"><canvas id="oilTrendsSpark3"></canvas></div>
                            </div>
                        </div>
                        <footer class="oil-trends-footer">
                            <button type="button" class="oil-trends-btn oil-trends-btn--ghost"
                                id="oilTrendsExport">Export</button>
                            <button type="button" class="oil-trends-btn oil-trends-btn--primary"
                                data-fancybox-close>Close</button>
                        </footer>
                    </div>
                </div>
            </div>
        </div>

        <script src="js/vendor/modernizr-3.5.0.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script>
        window.jQuery || document.write('<script src="js/vendor/jquery-3.2.1.min.js"><\/script>')
        </script>
        <script src="js/jquery.contextMenu.min.js" type="text/javascript"></script>
        <script src="js/jquery.ui.position.min.js" type="text/javascript"></script>
        <script src="js/jquery.fancybox.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <script src="js/process.js"></script>
        <script src="js/context_menu.js"></script>
        <script src="js/events.js"></script>
        <script src="js/chart.js"></script>


    </body>

</html>