
var stepType = 'T';
var currentEvent = 0;
var totalEvent = 8;

var $html = $('html'),
        stepMethord = true;


function changeStepMethord() {
    $(this).click(function() {
        $html.find('#settings-panel .step-methord').show();
        $(this).hide();
        stepMethord = (stepMethord == true) ? false : true;
        if (stepMethord) {
            $("#pro_back").show();
            $("#pro_fwd").show();
            stepType = 'T';
        } else {
            if (currentEvent == 1) {
                $("#pro_back").hide();
            } else if (currentEvent == totalEvent) {
                $("#pro_back").hide();
            }
            stepType = 'E';
        }
    })
}


//To Change and Reset  pipe color
function changePipColor(pipeID, className) {
    $pipe = $('#' + pipeID + '');

    $pipe.find('path').removeClass('oil-fill cooling-water-fill water-fill phosphoric-fill caustic-fill ejection-fill');
    $pipe.find('path').addClass(className);
}

function resetPipe(pipeID) {
    $('#' + pipeID + '').find('path').removeClass('oil-fill cooling-water-fill water-fill phosphoric-fill caustic-fill ejection-fill');
}

//to Change and Reset pump color.
function pumpColor(pumId, className) {
    var pump = $('#' + pumId + '');

    pump.find('.bg-path').removeClass('pump-running', 'pump-maintenance');
    pump.find('.bg-path').addClass(className);
}


function resetPumpColor(pumId) {
    $('#' + pumId + '').find('.bg-path').each(function(index) {
        $(this).removeClass('pump-running pump-maintenance');
    });
}



function heating(staus)
{
    if (staus)
    {
        $('#btn_heating').removeClass('heating');
        $('#btn_heating').addClass('heating-on');
    } else
    {
        $('#btn_heating').removeClass('heating-on');
        $('#btn_heating').addClass('heating');
    }
}

function cooling(staus)
{
    if (staus)
    {
        $('#btn_cooling').removeClass('cooling');
        $('#btn_cooling').addClass('cooling-on');
    } else
    {
        $('#btn_cooling').removeClass('cooling-on');
        $('#btn_cooling').addClass('cooling');
    }
}

// chane Valve Coler
function changeValveColor(vlveId, top, right, bottom, left, className) {
    $valve = $('#' + vlveId + '');

    if (top == 1) {
        $valve.find('.top').addClass(className);
    }
    if (right == 1) {
        $valve.find('.right').addClass(className);
    }
    if (bottom == 1) {
        $valve.find('.bottom').addClass(className);
    }
    if (bottom == 1) {
        $valve.find('.left').addClass(className);
    }
}
function pvValveOpen(vlveId)
{
    resetValve(vlveId);
    $valve = $('#' + vlveId + '');
    $valve.find('.top').addClass('valve-open');
    $valve.find('.right').addClass('valve-open');
    $valve.find('.left').addClass('valve-open');
    $valve.find('.bottom').addClass('valve-open');
}
function pvValveClose(vlveId)
{
    resetValve(vlveId);
}
function valveOpenUp(vlveId)
{
    resetValve(vlveId);
    $valve = $('#' + vlveId + '');
    $valve.find('.top').addClass('valve-open');
    $valve.find('.right').addClass('valve-open');
    $valve.find('.left').addClass('valve-open');
}

function valveOpenDown(vlveId)
{
    resetValve(vlveId);
    $valve = $('#' + vlveId + '');
    $valve.find('.right').addClass('valve-open');
    $valve.find('.left').addClass('valve-open');
    $valve.find('.bottom').addClass('valve-open');
}
function valveClosed(vlveId)
{
    resetValve(vlveId);
}
function valveMaintaince(vlveId)
{
    $valve = $('#' + vlveId + '');
    $valve.find('.top').addClass('valve-maintenance');
    $valve.find('.right').addClass('valve-maintenance');
    $valve.find('.left').addClass('valve-maintenance');
    $valve.find('.bottom').addClass('valve-maintenance');
}

function resetValve(vlveId) {
    $('#' + vlveId + '').find('.change-bg').each(function(index) {
        $(this).removeClass('valve-open valve-maintenance');
    });
}


function defaultFillTank(status, tankId, prasontage, fillColor) {
    var $tank = $('#' + tankId + ''),
            $fillColor = fillColor,
            cnt = $tank.find("#count"),
            water = $tank.find("#water"),
            percent = cnt.text(),
            color = '#31538fff',
            interval;
    if ($fillColor == 'oil-fill') {
        color = '#f4b081ff';
    } else if ($fillColor == 'cooling-water-fill') {
        color = '#00b050ff';
    } else if ($fillColor == 'water-fill') {
        color = '#31538fff';
    } else if ($fillColor == 'phosphoric-fill') {
        color = '#e79695ff';
    } else if ($fillColor == 'caustic-fill') {
        color = '#e896d6ff';
    } else if ($fillColor == 'ejection-fill') {
        color = '#3d6c2eff';
    }
    water.css('background', color);
    water.find('svg').show();
    $tank.find('.water_wave_front').addClass($fillColor);
    $tank.find('.water_wave_back').addClass($fillColor).css('opacity', 0.6);
    cnt.html(prasontage);
    water[0].style.transform = 'translate(0' + ',' + (100 - prasontage) + '%)';

}
function fillTank(status, tankId, prasontage, fillColor) {
    var $tank = $('#' + tankId + ''),
            $fillColor = fillColor,
            cnt = $tank.find("#count"),
            water = $tank.find("#water"),
            percent = cnt.text(),
            color = '#31538fff',
            interval;

    if ($fillColor == 'oil-fill') {
        color = '#f4b081ff';
    } else if ($fillColor == 'cooling-water-fill') {
        color = '#00b050ff';
    } else if ($fillColor == 'water-fill') {
        color = '#31538fff';
    } else if ($fillColor == 'phosphoric-fill') {
        color = '#e79695ff';
    } else if ($fillColor == 'caustic-fill') {
        color = '#e896d6ff';
    } else if ($fillColor == 'ejection-fill') {
        color = '#3d6c2eff';
    }

    if (status == 'fill') {
        water.css('background', color);
        water.find('svg').show();
        $tank.find('.water_wave_front').addClass($fillColor);
        $tank.find('.water_wave_back').addClass($fillColor).css('opacity', 0.6);

        interval = setInterval(function() {
            percent++;
            cnt.html(percent);
            water[0].style.transform = 'translate(0' + ',' + (100 - percent) + '%)';

            if (percent == prasontage) {
                clearInterval(interval);
            }
        }, 50);

    } else {

        interval = setInterval(function() {
            percent--;
            cnt.html(percent);
            water[0].style.transform = 'translate(0' + ',' + (100 - percent) + '%)';

            if (percent == prasontage) {
                clearInterval(interval);
                if (percent == 0) {
                    water.css('background', 'none');
                    water.find('svg').hide();
                    $tank.find('.water_wave_front').removeClass($fillColor);
                    $tank.find('.water_wave_back').removeClass($fillColor);
                }

            }
        }, 50);
    }
}

function changeMixer(mixId, className) {
    var mixer = $('#' + mixId + ''),
        fan = $('#mix' + mixId.substring(1) + ''),
        runningMixfan = 'img/elements/mix1.gif',
        stopedMixfan = 'img/elements/mix.png';

    if(mixId === 'm-201'){
        runningMixfan = 'img/elements/mix2.gif',
        stopedMixfan = 'img/elements/mix2.png';
    }

    mixer.find('.bg-path').removeClass('pump-running', 'pump-maintenance');
    mixer.find('.bg-path').addClass(className);

    if (className === 'pump-running') {
        fan.attr('src', runningMixfan);
    } else {
        fan.attr('src', stopedMixfan);
    }
}
function resetMixer(mixId) {
    var resetMixImg = 'img/elements/mix.png';

    if(mixId === 'm-201'){
        resetMixImg = 'img/elements/mix2.png';
    }

    $('#' + mixId + '').find('.bg-path').each(function(index) {
        $(this).removeClass('pump-running pump-maintenance');
    });
    $('#mix' + mixId.substring(1) + '').attr('src', resetMixImg);
}

$(document).ready(function() {

    $('#settings-panel .step-methord').each(changeStepMethord);

    //replace image to svg tag
    $('img.svg').each(function() {
        var $img = $(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        $.get(imgURL, function(data) {

            var $svg = $(data).find('svg');

            if (typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }

            if (typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass + ' replaced-svg');
            }

            $svg = $svg.removeAttr('xmlns:a');

            $img.replaceWith($svg);
        });
    });

    // sumpl aplying
    $('#acton-btn').click(function() {

        changePipColor('pi-a-1', 'caustic-fill');

        changeValveColor('v-201', 1, 0, 1, 1, 'valve-open');

        fillTank('fill', 'tk-202', 90, 'phosphoric-fill');
        defaultFillTank('fill', 'tk-204', 60, 'cooling-water-fill');


        changeMixer('m-203', 'pump-running');

    })

    $('#reset-btn').click(function() {
        resetPumpColor('p-201');
        resetPipe('pi-a-1');
        resetValve('v-201');
        fillTank('reset', 'tk-204', 10, 'cooling-water-fill');
        resetMixer('m-203');
    })
    /// Close Dom ready       
});
