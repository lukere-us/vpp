/*
 * @Lakmal 
 * 
 */



/**
 * @Button Status
 */

var PROCESS_SPEED = 1;
var START_TIMECOUNT = 0;
var CURRUNT_TIME_SECONDS = 0;
var SYSTEM_CURRUNT_STATUS = 'S'; //R-runnng,S-stop,P=paused,A=auto
var HEATLINE = false;
var COOLLINE = false;
var REFINEOIL = false
var HEVYPHASETANKEJECT = false;


/*
 * @Phosphoric  Acid Tank Parameters(TK201)
 */
var TK201_CP = 100;//Capacity(Leters)
var TK201_HL = 100;//High Level Set Point 
var TK201_OL = 100;//Operate Level Set Point 
var TK201_OL_DEF = 100;//Operate Level default 
var TK201_LL = 10;//Low Level Setpoint 
var TK201_LLL = 2;//Low-Low Level Setpoint 
var HLS_201 = false;//High Level Sensor
var LLS_201 = false;//Low Level Sensor

//@Acid dosing rate (%) of oil flow rate

var TK201_DS_MX = 0.04;//Acid dosing rate Max
var TK201_DS_MN = 0.02;//Acid dosing rate Min
var TK201_DS_OP = 0.02;//Acid dosing rate operate
var FFA = 1;//Gums % in oil 


/*
 * @Caustic Solution Tank Parameters(TK202)
 */
var TK202_CP = 100;//Capacity(Leters)
var TK202_HL = 100;//High Level Set Point 
var TK202_OL = 100;//Operate Level Set Point 
var TK202_OL_DEF = 100;//Operate Level default
var TK202_LL = 10;//Low Level Setpoint 
var TK202_LLL = 0;//Low-Low Level Setpoint 
var HLS_202 = false;//High Level Sensor
var LLS_202 = false;//Low Level Sensor

//@Caustc dosing rate (%) of oil flow rate

var TK202_DS_MX = 3;//Caustc dosing rate Max
var TK202_DS_MN = 0.1;//Caustc dosing rate Min
var TK202_DS_OP = 0.1;//Caustc dosing rate operate

/*
 * @Reaction Tank Parameters(TK204)
 */
var TK204_CP = 10000;//Capacity(Leters)
var TK204_HL = 98;//High Level Set Point 
var TK204_OL = 0;//Operate Level Set Point 
var TK204_OL_DEF = 50;
var TK204_SL = 75;//Set Level Set Point 
var TK204_LL = 10;//Low Level Setpoint 
var HLS_204 = false;//High Level Sensor
var LLS_204 = false;//Low Level Sensor
var REACTION_TANK_EJE_STATUS = false;

/*
 * @Water Tank Parameters(TK203)
 */
var TK203_CP = 10000;//Capacity(Leters)
var TK203_HL = 100;//High Level Set Point 
var TK203_OL = 100;//Operate Level Set Point 
var TK203_SL = 10;//Set Level Set Point 
var TK203_LL = 10;//Low Level Setpoint 
var HLS_203 = false;//High Level Sensor
var LLS_203 = false;//Low Level Sensor

//@Water dosing rate in line to production setting page

var TK203_DS_MX = 3;//Water dosing rate Max
var TK203_DS_MN = 1;//Water dosing rate Min
var TK203_DS_OP = 1;//Water dosing rate operate

/*
 * @Crude Oil  Parameters
 */
var T201_HL = 60;//Cured Oil Operation Temperature
var T201_OP = 40;//Cured Oil Operation Temperature
var T201_SP = 40;//Cured Oil Set Temperature
var T201_LL = 0;//Cured Oil Operation Temperature
var F201_OP = 5000; //Crude Oil Flow Rate Operate Level Set Point 
var F201_SP = 5000; //Crude Oil Flow Rate Set Level Set Point 

/*
 * @Separator controls parameter
 */
var SE_STATUS = 'S';//separator start or stop S-stop,R-ready,W-workng,RS-ready to shutdown
var SE_OPT = 'PR';//total ejection or partial ejection or product(PE | TE | PR)

var SE_TE_INT = 10;//Separator Total Ejection Interval(Min)
var SE_TE_D = 10;//Separator Total Ejection Duration(Sec)
var SE_PE_INT = 10;//Separator Partial Ejection Interval(Min)
var SE_PE_D = 10;//Separator Partial Ejection Duration(Sec)

var SE_ON_TIME = 0;//separator start time
var SE_OFF_SHEDULE_TIME = 0;//separator start time
var SE_LAST_TE_TIME = 0;//last total ejection time
var SE_LAST_PE_TIME = 0;//last partial ejection tme
var SE_OPERATION_TIME_COUNT = 0//total or partial ejection time count
var IS_SE_OPERATION_RUNNING = false;//operator start
var IS_TOTAL_EJECTION_RUNNNG = false;
var IS_PARTIAL_EJECTION_RUNNNG = false;
var SE_TE_OPERATION_TIME_COUNT = 0
var SE_PE_OPERATION_TIME_COUNT = 0

/*
 * @PV207 controls parameter
 */
var PV207_STATUS = 'OFF';//PV207 ON or Off
var PV209_FL = 5000;//PV207 Flow Rate

/*
 * @PV205 controls parameter
 */
var PV205_FL = 4000;//PV205 Flow Rate

/*
 * @Heavy Phase Tank Parameters
 */

var TK205_CP = 10000;//Capacity(Leters)
var TK205_HL = 100;//High Level Set Point 
var TK205_OL = 0;//Operate Level Set Point 
var TK205_OL_DEF = 0;//Operate Level Set Point 
var TK205_SL = 20;//Set Level Set Point 
var TK205_LL = 10;//Low Level Setpoint
var HEAVY_PHASE_TANK_EJE_STATUS = false;







var I_003 = ''; //Reasion message
var I_001 = ''; //Status indcater

/*
 * @Telemetry Parameters
 */
var TELEMETRY_COUNTER = 0; //Telemetry time counter
var TELEMETRY_INTERVAL = 10; //10 seconds

var intervalId;
var time = 0;

function roundDown(number, decimals) {
    decimals = decimals || 0;
    return (Math.floor(number * Math.pow(10, decimals)) / Math.pow(10, decimals));
}
function I_003MessageDisplay()
{
    $("#I_003").text(I_003);
}
function I_001StatusIndicater()
{
    $("#I_001").text(I_001);
}
function alarmIndicater(msg, colorClass)
{
    $('#alarm_msg').removeClass('alarm-warrning alarm-sucess');
    $("#alarm_msg").text(msg);
    $('#alarm_msg').addClass(colorClass);
    $("#alarm_msg").text(msg);
}

function heatngLine(status)
{

    if (status && !HEATLINE)
    {
        pvValveOpen('pv-204');
        valveOpenDown('v-201');
        valveOpenDown('v-202');
        changePipColor('pi-s-1', 'water-fill');
        changePipColor('pi-s-2', 'water-fill');
        changePipColor('pi-o-5', 'oil-fill');
        changePipColor('pi-o-6', 'oil-fill');
        changePipColor('pi-a-1', 'phosphoric-fill');
        changePipColor('pi-o-1', 'oil-fill');
        changePipColor('pi-o-4', 'oil-fill');
        changePipColor('m-202-bot-pipe', 'oil-fill');
        changePipColor('p-201-pump-bottom-pipe', 'phosphoric-fill');
        pumpColor('p-201', 'pump-running');
        pumpColor('p-203', 'pump-running');

        /*
         * @Caustic tank(TK202) operation
         */
        changePipColor('pi-c-1', 'caustic-fill');
        changePipColor('p-201-2-pump-bottom-pipe', 'caustic-fill');
        pumpColor('p-202', 'pump-running');
        changeMixer('m-202', 'pump-running');

        /*
         * @Water tank(TK0203) operation
         */
        changePipColor('pi-w-1', 'water-fill');
        defaultFillTank('fill', 'mixer-202', 100, 'oil-fill');
        HEATLINE = true;


    } else if (!status && HEATLINE)
    {
        pvValveClose('pv-204');
        valveClosed('v-201');
        valveClosed('v-202');
        resetPipe('pi-s-1');
        resetPipe('pi-s-2');
        resetPipe('pi-o-5');
        resetPipe('pi-o-6');
        resetPipe('pi-a-1');
        resetPumpColor('p-201');
        resetPipe('pi-o-1');
        resetPipe('m-202-bot-pipe');
        resetPipe('p-201-pump-bottom-pipe');
        resetPipe('pi-o-4');
        resetPipe('pi-c-1');

        pvValveClose('pv-204');
        valveClosed('v-201');
        valveClosed('v-202');
        resetPipe('pi-s-1');
        resetPipe('pi-s-2');
        resetPipe('pi-o-5');
        resetPipe('pi-o-6');
        resetPipe('pi-a-1');
        resetPipe('pi-o-1');
        resetPipe('pi-o-4');
        resetPipe('m-202-bot-pipe');
        resetPipe('p-201-pump-bottom-pipe');
        resetPumpColor('p-201');
        resetPumpColor('p-203');

        /*
         * @Caustic tank(TK202) operation
         */
        resetPipe('pi-c-1');
        resetPipe('p-201-2-pump-bottom-pipe');
        resetPumpColor('p-202');
        resetMixer('m-202');

        /*
         * @Water tank(TK0203) operation
         */
        resetPipe('pi-w-1');
        defaultFillTank('fill', 'mixer-202', 1, 'oil-fill');
        HEATLINE = false;


    }
}
function coolngLine(status)
{
    if (status && !COOLLINE)
    {
        pvValveOpen('pv-203');
        valveOpenUp('v-201');
        valveOpenUp('v-202');
        changePipColor('pi-cw-1', 'water-fill');
        changePipColor('pi-cw-2', 'water-fill');
        changePipColor('pi-o-2', 'oil-fill');
        changePipColor('pi-o-3', 'oil-fill');
        changePipColor('pi-a-1', 'phosphoric-fill');
        changePipColor('pi-o-1', 'oil-fill');
        changePipColor('pi-o-4', 'oil-fill');
        changePipColor('m-202-bot-pipe', 'oil-fill');
        changePipColor('p-201-pump-bottom-pipe', 'phosphoric-fill');

        pumpColor('p-201', 'pump-running');
        pumpColor('p-203', 'pump-running');

        /*
         * @Caustic tank(TK202) operation
         */
        changePipColor('pi-c-1', 'caustic-fill');
        changePipColor('p-201-2-pump-bottom-pipe', 'caustic-fill');
        pumpColor('p-202', 'pump-running');
        changeMixer('m-202', 'pump-running');
        /*
         * @Water tank(TK0203) operation
         */
        changePipColor('pi-w-1', 'water-fill');
        defaultFillTank('fill', 'mixer-202', 100, 'oil-fill');
        COOLLINE = true;
    } else if (!status && COOLLINE)
    {
        pvValveClose('pv-203');
        valveClosed('v-201');
        valveClosed('v-202');
        resetPipe('pi-cw-1');
        resetPipe('pi-cw-2');
        resetPipe('pi-o-2');
        resetPipe('pi-o-3');
        resetPipe('pi-a-1');
        resetPipe('pi-o-1');
        resetPipe('pi-o-4');
        resetPipe('m-202-bot-pipe');
        resetPipe('p-201-pump-bottom-pipe');

        resetPumpColor('p-201');
        resetPumpColor('p-203');

        /*
         * @Caustic tank(TK202) operation
         */
        resetPipe('pi-c-1');
        resetPipe('p-201-2-pump-bottom-pipe');
        resetPumpColor('p-202');
        resetMixer('m-202');
        /*
         * @Water tank(TK0203) operation
         */
        resetPumpColor('pi-w-1');
        defaultFillTank('fill', 'mixer-202', 1, 'oil-fill');
        COOLLINE = false;

    }
}
function acidTankFill() {
    var t = 0;
    var interval = setInterval(function() {
        TK201_OL = TK201_OL + 20;
        if (TK201_OL >= TK201_CP)
        {
            TK201_OL = TK201_CP;
            $('#hls-201').addClass("red");
            clearInterval(interval);
        } else {
            if (TK201_OL > TK201_LLL)
            {
                LLS_201 = false;
                $('#lls-201').removeClass("red");
                $('#llls-201').removeClass("red");
            }
        }
        defaultFillTank('fill', 'tk-201', roundDown(TK201_OL, 2), 'phosphoric-fill');
    }, 1000);
}

function acidTankOperation(action, time, ol)
{


    if (action == 'event')
    {
        TK201_OL = ol;
    } else {
        TK201_DS_OP = $('#TK201_DS').val();
        TK201_OL = TK201_OL - ((((F201_OP * TK201_DS_OP / 100) * time / 3600)) / TK201_CP) * 100;
    }
    TK201_OL = (TK201_OL < 0 ? 0 : TK201_OL);
    var tank = true;
    if (TK201_OL < TK201_CP) {
        $('#hls-201').removeClass("red");
    }
    if (TK201_OL <= TK201_LL)
    {
        if (TK201_OL <= TK201_LLL)
        {
            TK201_OL = TK201_LLL;
            tank = false;
            LLS_201 = true;
            stop();
        } else {
            LLS_201 = false;
        }
    } else {
        LLS_201 = false;
        $('#lls-201').removeClass("red");
        $('#llls-201').removeClass("red");
    }
    defaultFillTank('fill', 'tk-201', roundDown(TK201_OL, 2), 'phosphoric-fill')

}


function causticTankFill() {
    var t = 0;
    var interval = setInterval(function() {
        TK202_OL = TK202_OL + 20;
        if (TK202_OL >= TK202_CP)
        {
            TK202_OL = TK202_CP;
            $('#hls-202').addClass("red");
            clearInterval(interval);
        } else {

            if (TK202_OL > TK202_LLL)
            {
                LLS_202 = false;
                $('#lls-202').removeClass("red");
                $('#llls-202').removeClass("red");
            }
        }
        defaultFillTank('fill', 'tk-202', roundDown(TK202_OL, 2), 'caustic-fill')
    }, 1000);
}
function causticTankOperation(action, time, ol)
{
    if (action == 'event')
    {
        TK202_OL = ol;
    } else {
        TK202_DS_OP = $('#TK202_DS').val();
        TK202_OL = TK202_OL - (((F201_OP * TK202_DS_OP / 100) * (time / 3600)) / TK202_CP) * 100;
    }

    TK202_OL = (TK202_OL < 0 ? 0 : TK202_OL);
    if (TK202_OL < TK202_CP) {
        $('#hls-202').removeClass("red");
    }
    if (TK202_OL <= TK202_LL)
    {
        if (TK202_OL <= TK202_LLL)
        {
            TK202_OL = TK202_LLL;
            LLS_202 = true;
            stop();
        } else {
            LLS_202 = false;
        }
    } else {
        LLS_202 = false;
        $('#lls-202').removeClass("red");
        $('#llls-202').removeClass("red");
    }
    defaultFillTank('fill', 'tk-202', roundDown(TK202_OL, 2), 'caustic-fill')

}
function reactionTankOperation(action, time, ol)
{

    if (action == 'fill')
    {
        var fill = ((F201_OP * (time / 3600)) / TK204_CP);
        fill = roundDown(fill, 10);
        TK204_OL = TK204_OL + (fill * 100);
    } else if (action == 'event') {
        TK204_OL = ol;
    } else if (action == 'eject') {

        var eject = roundDown((((PV209_FL * time / 3600)) / TK204_CP), 10);
        TK204_OL = TK204_OL - (eject * 100);
    }
    if (TK204_OL > TK204_LL) {
        $('#lls-204').removeClass("red");
    }
    if (TK204_OL < TK204_HL)
    {
        HLS_204 = false;
        $('#hls-204').removeClass("red");

        if (TK204_OL <= TK204_LL) {
            TK204_OL = TK204_LL;
        }
    } else if (TK204_OL >= TK204_HL)
    {
        TK204_OL = TK204_HL;
        HLS_204 = true;
        stop();
    }
    defaultFillTank('fill', 'tk-204', roundDown(TK204_OL, 2), 'oil-fill');
}



function waterTankOperation(action, time)
{
    if (action == 'reset')
    {

    } else
    {
        TK203_DS_OP = $('#TK203_DS').val();
        TK203_OL = TK203_OL - (((TK203_DS_OP / 100) * time / 3600)) / TK203_CP;
        defaultFillTank('fill', 'tk-203', roundDown(TK203_OL, 2), 'water-fill');
    }
}

function refinedOil(action, time)
{
    if (action)
    {
        /*
         * @PV207 opton
         */
        if (PV207_STATUS == 'TF')//PV207 opton is tank farm
        {
            valveOpenUp('pv-207');
            pvValveOpen('pv-209');
            changePipColor('pi-o-11', 'oil-fill');
            resetPipe('pi-o-10');
        } else if (PV207_STATUS == 'D')//PV207 is drying
        {
            valveOpenDown('pv-207');
            pvValveOpen('pv-209');
            changePipColor('pi-o-10', 'oil-fill');
            resetPipe('pi-o-11');
        }
        pumpColor('p-204', 'pump-running');
        changePipColor('pi-o-08', 'oil-fill');
        changePipColor('pi-o-09', 'oil-fill');
        changePipColor('pi-o-10-1', 'oil-fill');
        changePipColor('pi-o-10-2', 'oil-fill');
        changePipColor('ro-pv-1', 'oil-fill');
        changePipColor('ro-pv-2', 'oil-fill');
        changePipColor('pi-s-4', 'water-fill');
        changePipColor('pi-s-05-1', 'water-fill');
        changePipColor('pi-s-05-2', 'water-fill');
        pvValveOpen('pv-205');
        pvValveOpen('pv-206');
        (!REFINEOIL ? changeMixer('m-203', 'pump-running') : '');
        (!REFINEOIL ? changeMixer('m-205', 'pump-running') : '');
        reactionTankOperation('eject', time);
        REFINEOIL = true;

    } else {
        (PV207_STATUS == 'OFF' ? valveClosed('pv-207') : '');
        pvValveClose('pv-209');
        resetPipe('pi-o-10');
        resetPipe('pi-o-11');

        resetPipe('pi-o-08');
        resetPipe('pi-o-09');
        resetPipe('pi-o-10-1');
        resetPipe('pi-o-10-2');
        resetPipe('ro-pv-1');
        resetPipe('ro-pv-2');
        resetPipe('pi-s-4');
        resetPipe('pi-s-05-1');
        resetPipe('pi-s-05-2');
        resetPumpColor('p-204');
        pvValveClose('pv-206');
        pvValveClose('pv-205');
        (REFINEOIL ? resetMixer('m-203') : '');
        (REFINEOIL ? resetMixer('m-205') : '');
        REFINEOIL = false;
    }
}

function ejecton(action, time, ol) {

    if (action == 'event') {
        TK205_OL = ol;
        resetPipe('pi-e-2');
        resetPipe('pi-hp-1');
    } else if (action) {
        changePipColor('pi-e-2', 'ejection-fill');
        var g = $('#FFA').val();
        var HPF = F201_OP * 2 * g / 100;
        TK205_OL = TK205_OL + ((HPF * time / 3600) / TK205_CP) * 100;
    } else {
        resetPipe('pi-e-2');
    }
    /*
     * @Hevy pahse tank filling
     */
    if (TK205_OL > TK205_LL) {
        $('#lls-205').removeClass("red");
    }
    if (TK205_OL > TK205_HL) {
        TK205_OL = TK205_HL;
    }
    defaultFillTank('fill', 'tk-205', roundDown(TK205_OL, 2), 'ejection-fill');
}

function heavyPhaseEjection(action, time, ol) {

    var hpeStaus = false;
    if (!HEAVY_PHASE_TANK_EJE_STATUS) {
        HEAVY_PHASE_TANK_EJE_STATUS = (TK205_OL >= TK205_SL ? true : false);
    } else {
        if (TK205_OL > TK205_LL) {
            hpeStaus = true;
        } else {
            HEAVY_PHASE_TANK_EJE_STATUS = false;
        }
    }
    /*
     * @Hevy pahse tank ejection
     */
    if (action == 'event') {
        TK205_OL = ol;
    } else if (action) {
        if (hpeStaus) {
            TK205_OL = TK205_OL - ((PV205_FL * time / 3600) / TK205_CP) * 100;
            pumpColor('p-205', 'pump-running');
            HEVYPHASETANKEJECT = true;
        } else {
            resetPumpColor('p-205');
            HEVYPHASETANKEJECT = false;
        }
    } else {
        resetPumpColor('p-205');
        HEVYPHASETANKEJECT = false;
    }
    if (TK205_OL < TK205_HL) {
        $('#hls-205').removeClass("red");
    }
    defaultFillTank('fill', 'tk-205', roundDown(TK205_OL, 2), 'ejection-fill');
}

function feedOil(time)
{

    TK201_DS_OP = $('#TK201_DS').val();
    TK202_DS_OP = $('#TK202_DS').val();
    TK203_DS_OP = $('#TK203_DS').val();
    T201_OP = $('#T201').val();
    $("#F201_OP").text(F201_OP + ' Lt/H');
    $("#F201_SP").text(F201_SP + ' Lt/H');
    $("#T201_OP").text(T201_OP + ' C');
    $("#T201_SP").text(T201_SP + ' C');


    /*
     * @Cured oil(T1)temp less than define temp(T201) then heating ON else cooling ON
     */

    if (T201_OP < T201_SP)
    {
        //Heating ON
        coolngLine(false);
        heatngLine(true);
        cooling(false);
        heating(true);
        acidTankOperation('eject', time);
        causticTankOperation('eject', time);
        waterTankOperation('eject', time);
        reactionTankOperation('fill', time);

    }
    else if (T201_OP >= T201_SP)
    {
        heatngLine(false);
        coolngLine(true);
        heating(false);
        cooling(true);
        acidTankOperation('eject', time);
        causticTankOperation('eject', time);
        waterTankOperation('eject', time);
        reactionTankOperation('fill', time);

    }
}

function totalEjecton(action, time) {
    if (action) {
        changePipColor('pi-water-2', 'water-fill');
        changePipColor('pi-water-1', 'water-fill');
        pvValveOpen('pv-208');
    } else {
        resetPipe('pi-water-2');
        resetPipe('pi-water-1');
        pvValveClose('pv-208');
    }
}

function manualTotalEjecton() {
    if (SE_STATUS == 'W' && (CURRUNT_TIME_SECONDS - SE_ON_TIME) * PROCESS_SPEED >= 900) {
        var manualTotalEjectonTime = 0;
        var totalEjectionTimeDuration = 0;
        var interval = setInterval(function() {
            if (totalEjectionTimeDuration >= SE_TE_D)
            {
                clearInterval(interval);
                ejecton(false, time);
                totalEjecton(false, time);
                refinedOil(false, time);
                manualTotalEjectonTime = 0;
                totalEjectionTimeDuration = 0;
            } else {
                manualTotalEjectonTime++;
                totalEjectionTimeDuration = manualTotalEjectonTime * PROCESS_SPEED;
                ejecton(true, time);
                totalEjecton(true, time);
                refinedOil(false, time);
            }
        }, 1000);
    }
}

function separatorOperation(status, time) {
    /*
     * @Separator feed
     * @Refind oil
     */

    /*
     * @Condition
     * Reaction tank level should be set level
     * Separator should be ON status
     * Separator have pass 15 mniute from start
     * PV207 val should be open
     */

    var recStaus = false;
    if (!REACTION_TANK_EJE_STATUS) {
        REACTION_TANK_EJE_STATUS = (TK204_OL >= TK204_SL ? true : false);
    } else {
        if (TK204_OL > TK204_LL) {
            recStaus = true;
        } else {
            REACTION_TANK_EJE_STATUS = false;
        }
    }

    if ((status == 'event') || (recStaus && status && (CURRUNT_TIME_SECONDS - SE_ON_TIME) * PROCESS_SPEED >= 900 && PV207_STATUS != 'OFF'))
    {
        heavyPhaseEjection(true, time);
        if (SE_OPT == 'PE')//Separator option partial ejection
        {
            refinedOil(true, time);
            changePipColor('pi-hp-1', 'ejection-fill');
            if (!IS_SE_OPERATION_RUNNING)
            {
                if (((CURRUNT_TIME_SECONDS - SE_LAST_PE_TIME) * PROCESS_SPEED) >= SE_PE_INT)
                {
                    SE_LAST_PE_TIME = CURRUNT_TIME_SECONDS;
                    IS_SE_OPERATION_RUNNING = true;
                }
            }
            if (IS_SE_OPERATION_RUNNING) {
                if (SE_OPERATION_TIME_COUNT * PROCESS_SPEED > SE_PE_D)
                {
                    IS_SE_OPERATION_RUNNING = false;
                    SE_OPERATION_TIME_COUNT = 0;
                    ejecton(false, time);
                } else {
                    SE_OPERATION_TIME_COUNT++;
                    ejecton(true, time);
                }
            }

        } else if (SE_OPT == 'TE')
        {
            if (!IS_SE_OPERATION_RUNNING)
            {
                if (((CURRUNT_TIME_SECONDS - SE_LAST_TE_TIME) * PROCESS_SPEED) / 60 >= SE_TE_INT)
                {
                    SE_LAST_TE_TIME = CURRUNT_TIME_SECONDS;
                    IS_SE_OPERATION_RUNNING = true;
                }
                refinedOil(true, time);
            } else
            {
                if (SE_OPERATION_TIME_COUNT * PROCESS_SPEED > SE_TE_D)
                {
                    IS_SE_OPERATION_RUNNING = false;
                    SE_OPERATION_TIME_COUNT = 0;
                    ejecton(false, time);
                    totalEjecton(false, time);
                    refinedOil(true, time);

                } else {
                    SE_OPERATION_TIME_COUNT++;
                    ejecton(true, time);
                    totalEjecton(true, time);
                    refinedOil(false, time);
                }
            }
        } else if (SE_OPT == 'PR') {
            //partial ejection
            if (!IS_TOTAL_EJECTION_RUNNNG) {
                if (!IS_PARTIAL_EJECTION_RUNNNG)
                {

                    if (((CURRUNT_TIME_SECONDS - SE_LAST_PE_TIME) * PROCESS_SPEED) >= SE_PE_INT)
                    {
                        SE_LAST_PE_TIME = CURRUNT_TIME_SECONDS;
                        IS_PARTIAL_EJECTION_RUNNNG = true;
                    }
                }
                if (IS_PARTIAL_EJECTION_RUNNNG) {
                    if (SE_PE_OPERATION_TIME_COUNT * PROCESS_SPEED > SE_PE_D)
                    {
                        IS_PARTIAL_EJECTION_RUNNNG = false;
                        SE_PE_OPERATION_TIME_COUNT = 0;
                        ejecton(false, time);
                    } else {
                        SE_PE_OPERATION_TIME_COUNT++;
                        ejecton(true, time);
                    }
                }

            } else {
                IS_PARTIAL_EJECTION_RUNNNG = false;
                SE_PE_OPERATION_TIME_COUNT = 0;
            }

            //Total ejection
            if (!IS_TOTAL_EJECTION_RUNNNG)
            {
                if (((CURRUNT_TIME_SECONDS - SE_LAST_TE_TIME) * PROCESS_SPEED) / 60 >= SE_TE_INT)
                {
                    SE_LAST_TE_TIME = CURRUNT_TIME_SECONDS;
                    IS_TOTAL_EJECTION_RUNNNG = true;
                }
            } else
            {
                if (SE_TE_OPERATION_TIME_COUNT * PROCESS_SPEED > SE_TE_D)
                {
                    IS_TOTAL_EJECTION_RUNNNG = false;
                    SE_TE_OPERATION_TIME_COUNT = 0;
                    ejecton(false, time);
                    totalEjecton(false, time);
                    refinedOil(true, time);

                } else {
                    SE_TE_OPERATION_TIME_COUNT++;
                    ejecton(true, time);
                    totalEjecton(true, time);
                    refinedOil(false, time);
                    resetPipe('pi-hp-1');
                }
            }

            if (!IS_TOTAL_EJECTION_RUNNNG && !IS_PARTIAL_EJECTION_RUNNNG) {
                refinedOil(true, time);
                changePipColor('pi-hp-1', 'ejection-fill');
                ejecton(false, time);
            }

        }

    } else {
        if (SE_STATUS == 'W' && SYSTEM_CURRUNT_STATUS == 'A') {
            //separatorOnOff(false);
        }
        refinedOil(false, time);
        heavyPhaseEjection(false, time);
        ejecton(false, time);
        resetPipe('pi-water-2');
        resetPipe('pi-water-1');
        pvValveClose('pv-208');
        resetPipe('pi-hp-1');
    }
}


function stop(msg)
{
    coolngLine(false);
    heatngLine(false);
    cooling(false);
    heating(false);
    I_003 = 'No path';
    I_001 = 'Stopped';
    if (msg) {
        alarmIndicater(msg, 'alarm-warrning');
        I_003MessageDisplay();
    }
    I_001StatusIndicater();
}
function pause(msg)
{
    var mixer = ['m-201', 'm-202', 'm-203']
    var pump = ['p-201', 'p-202', 'p-203'];
    var val = ['v-201', 'v-202', 'pv-204', 'p-202', 'p-203', 'm-203'];
    var pipe = ['pi-o-1', 'pi-o-2', 'pi-o-3', 'pi-o-4', 'pi-o-5', 'pi-o-6', 'pi-cw-1', 'pi-cw-2', 'pi-s-1', 'pi-o-2', 'pi-a-1', 'pi-o-7', 'pi-c-1', 'pi-w-1'];

    for (var i in mixer) {
        changeMixer(mixer[i], 'pump-maintenance');
    }
    for (var i in pump) {
        pumpColor(pump[i], 'pump-maintenance');
    }
    for (var i in val) {
        valveMaintaince(val[i]);
    }
    for (var i in pipe) {
        resetPipe(pipe[i]);
    }
}




/*
 * @Separator controller settngs
 */
$('#separator_status').click(function() {
    if ($('#separator_status').prop('checked')) {
        SE_STATUS = 'R';
        $("#sep_time").css("display", "block");
        $("#separator_status").prop("disabled", true);
        SE_ON_TIME = CURRUNT_TIME_SECONDS;
        SE_LAST_PE_TIME = CURRUNT_TIME_SECONDS;
        SE_LAST_TE_TIME = CURRUNT_TIME_SECONDS;
    } else {
        SE_STATUS = 'RS';
    }
});
$("input[name='separator_opt']").change(function() {
    SE_OPT = $('input[name=separator_opt]:checked').val();
});




/*
 * @controll process speed
 */
$("#pro_fwd").click(function() {
    if (stepType == 'T') {
        if (PROCESS_SPEED < 3600) {
            PROCESS_SPEED++;
        }
        $("#pro_speed").text('X ' + PROCESS_SPEED);
    } else {
        $("#pro_back").show();
        if (currentEvent < totalEvent) {
            currentEvent++;
            if (currentEvent == totalEvent) {
                $("#pro_fwd").hide();
            }
            runEvent(currentEvent);
        }
    }
});
$("#pro_back").click(function() {
    if (stepType == 'T') {
        if (PROCESS_SPEED > 1) {
            PROCESS_SPEED--;
        }
        $("#pro_speed").text('X ' + PROCESS_SPEED);
    } else {
        $("#pro_fwd").show();
        if (currentEvent > 1) {
            currentEvent--;
            if (currentEvent == 1) {
                $("#pro_back").hide();
            }
            runEvent(currentEvent);
        }
    }
});


var int;
$("#pro_fwd").mousedown(function() {
    if (stepType == 'T') {
        int = setInterval(function() {
            if (PROCESS_SPEED < 3600) {
                PROCESS_SPEED++;
            }
            $("#pro_speed").text('X ' + PROCESS_SPEED);
        }, 100);
    }
}).mouseup(function() {
    if (stepType == 'T') {
        clearInterval(int);
    }
});

$("#pro_back").mousedown(function() {
    if (stepType == 'T') {
        int = setInterval(function() {
            if (PROCESS_SPEED > 1) {
                PROCESS_SPEED--;
            }
            $("#pro_speed").text('X ' + PROCESS_SPEED);
        }, 100);
    }
}).mouseup(function() {
    if (stepType == 'T') {
        clearInterval(int);
    }
});


/*
 * @producton setting
 */
$("#production_setting").click(function() {
    TK201_DS_OP = $('#TK201_DS').val();
    TK202_DS_OP = $('#TK202_DS').val();
    TK203_DS_OP = $('#TK203_DS').val();
    FFA = $('#FFA').val();
    T201_OP = $('#T201').val();
    $('#T201_OP').text(T201_OP + ' C');
    $("#acid_val").text(TK201_DS_OP + ' %');
    $("#caustic_val").text(TK202_DS_OP + ' %');
});


/*
 * @Time display
 */
Date.prototype.addSeconds = function(seconds) {
    this.setSeconds(this.getSeconds() + seconds);
    return this;
};
Date.prototype.addMinutes = function(minutes) {
    this.setMinutes(this.getMinutes() + minutes);
    return this;
};

Date.prototype.addHours = function(hours) {
    this.setHours(this.getHours() + hours);
    return this;
};

function startTime(now) {

    var today = new Date();
    var y = today.getFullYear();
    var mo = today.getMonth();
    var d = today.getDate();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    CURRUNT_TIME_SECONDS = parseInt(h * 60 * 60) + parseInt(m * 60) + parseInt(s);
    //var newToday = new Date(y, mo, d, h, m, s * PROCESS_SPEED, 0);
    var sp_h = (parseInt(PROCESS_SPEED / 3600));
    var sp_m = (parseInt((PROCESS_SPEED % 3600) / 60));
    var sp_s = ((PROCESS_SPEED % 3600) % 60);
    now.addHours(sp_h);
    now.addMinutes(sp_m);
    now.addSeconds(sp_s);

    var nh = now.getHours();
    var nm = now.getMinutes();
    var ns = now.getSeconds();
    nh = checkTime(nh);
    nm = checkTime(nm);
    ns = checkTime(ns);
    document.getElementById('time_display').innerHTML = nh + ":" + nm + ":" + ns + (nh >= 12 ? ' PM' : ' AM');

    //h + ":" + m + ":" + s;
    setTimeout(function() {
        startTime(now);
    }, 1000)
}
function checkTime(i) {
    if (i < 10) {
        i = "0" + i
    }
    ;  // add zero in front of numbers < 10
    return i;
}

/*
 * @Telemetry function to send TK204 level data
 */
function sendTelemetry() {
    // Get simulation time from display
    var timeDisplay = document.getElementById('time_display').innerHTML;
    var timeParts = timeDisplay.split(' ')[0].split(':');
    
    var now = new Date();
    var simDate = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 
                           parseInt(timeParts[0]), parseInt(timeParts[1]), parseInt(timeParts[2]));
    
    var timestamp = simDate.getFullYear() + '-' + 
                    checkTime(simDate.getMonth() + 1) + '-' + 
                    checkTime(simDate.getDate()) + ' ' + 
                    checkTime(simDate.getHours()) + ':' + 
                    checkTime(simDate.getMinutes()) + ':' + 
                    checkTime(simDate.getSeconds());
    
    // Send TK204 - Reaction Tank
    $.ajax({
        url: 'https://1rpjk7n5pl.execute-api.ap-southeast-2.amazonaws.com/prod/telemetry',
        type: 'POST',
        contentType: 'application/json',
        headers: {
            'x-api-key': 'UBKmr2pqzaaa5E6Nd4Mrx78KRnrbiK4k2YgZTm5f'
        },
        data: JSON.stringify({
            plant_id: "DEMO_PLANT",
            sensor_id: "neutralizing_TK204",
            sensor_type: "Reaction Tank Level",
            value: roundDown(TK204_OL, 2),
            unit: "%",
            timestamp: timestamp
        }),
        success: function(response) {
            console.log('TK204 telemetry sent:', roundDown(TK204_OL, 2) + '%');
        },
        error: function(xhr, status, error) {
            console.error('TK204 telemetry failed:', error);
        }
    });
    
    // Send TK201 - Acid Solution Tank
    $.ajax({
        url: 'https://1rpjk7n5pl.execute-api.ap-southeast-2.amazonaws.com/prod/telemetry',
        type: 'POST',
        contentType: 'application/json',
        headers: {
            'x-api-key': 'UBKmr2pqzaaa5E6Nd4Mrx78KRnrbiK4k2YgZTm5f'
        },
        data: JSON.stringify({
            plant_id: "DEMO_PLANT",
            sensor_id: "neutralizing_TK201",
            sensor_type: "Acid Solution Tank Level",
            value: roundDown(TK201_OL, 2),
            unit: "%",
            timestamp: timestamp
        }),
        success: function(response) {
            console.log('TK201 telemetry sent:', roundDown(TK201_OL, 2) + '%');
        },
        error: function(xhr, status, error) {
            console.error('TK201 telemetry failed:', error);
        }
    });
    
    // Send TK202 - Caustic Solution Tank
    $.ajax({
        url: 'https://1rpjk7n5pl.execute-api.ap-southeast-2.amazonaws.com/prod/telemetry',
        type: 'POST',
        contentType: 'application/json',
        headers: {
            'x-api-key': 'UBKmr2pqzaaa5E6Nd4Mrx78KRnrbiK4k2YgZTm5f'
        },
        data: JSON.stringify({
            plant_id: "DEMO_PLANT",
            sensor_id: "neutralizing_TK202",
            sensor_type: "Caustic Solution Tank Level",
            value: roundDown(TK202_OL, 2),
            unit: "%",
            timestamp: timestamp
        }),
        success: function(response) {
            console.log('TK202 telemetry sent:', roundDown(TK202_OL, 2) + '%');
        },
        error: function(xhr, status, error) {
            console.error('TK202 telemetry failed:', error);
        }
    });
}

function separatorOnOff(staus) {
    if (staus) {
        var separater_start_time_diff = (CURRUNT_TIME_SECONDS * PROCESS_SPEED - SE_ON_TIME * PROCESS_SPEED);
        if (separater_start_time_diff >= 900) {
            $("#sep_time").text('(Separator ON)');
            $("#separator_status").prop("disabled", false);
            SE_STATUS = 'W'
        } else {
            var sep_runtme = roundDown((separater_start_time_diff) / 60, 2);
            $("#sep_time").text('(' + sep_runtme + ' Min)');
        }
    } else {
        $("#separator_status").prop("disabled", true);
        if (SE_OFF_SHEDULE_TIME > 0) {
            var separater_off_time_diff = (CURRUNT_TIME_SECONDS * PROCESS_SPEED - SE_OFF_SHEDULE_TIME * PROCESS_SPEED);
            if (separater_off_time_diff >= 900) {
                $("#sep_time").text('(Separator OFF)');
                $("#separator_status").prop("disabled", false);
                $('#separator_status').prop('checked', false);
                SE_OFF_SHEDULE_TIME = 0;
                SE_STATUS = 'S';
            } else {
                var sep_runtme = roundDown(15 - ((separater_off_time_diff) / 60), 2);
                $("#sep_time").text('(' + sep_runtme + ' Min)');
            }
        } else {
            SE_OFF_SHEDULE_TIME = CURRUNT_TIME_SECONDS;
        }

    }
}

$(document).ready(function() {
    var feedoil = false;
    var today = new Date();
    startTime(today);
    $('#B_001').addClass("deactivated");
    $('#B_002').addClass("deactivated");
    $('#B_003').addClass("deactivated");
    /*
     * @separator option
     */
    SE_OPT = $('input[name=separator_opt]:checked').val();


    /*
     * @Set default seetings
     */
    $('#TK201_DS').val(TK201_DS_OP);
    $('#TK202_DS').val(TK202_DS_OP);
    $('#TK203_DS').val(TK203_DS_OP);
    $('#FFA').val(FFA);
    $('#T201').val(T201_OP);
    $("#acid_val").text(TK201_DS_OP + ' %');
    $("#caustic_val").text(TK202_DS_OP + ' %');

    $("#F201_OP").text(F201_OP + ' Lt/H');
    $("#F201_SP").text(F201_SP + ' Lt/H');
    $("#T201_OP").text(T201_OP + ' C');
    $("#T201_SP").text(T201_SP + ' C');

    /*
     * @set TK201 & TK202 & TK204 default filled 
     */
    defaultFillTank('fill', 'tk-201', TK201_OL, 'phosphoric-fill');//Acid Tank
    defaultFillTank('fill', 'tk-202', TK202_OL, 'caustic-fill');//Caustic Tank
    defaultFillTank('fill', 'tk-203', TK203_OL, 'water-fill');//Water Tank
    defaultFillTank('fill', 'tk-204', TK204_OL, 'oil-fill');//Reaction Tank



    if (intervalId)
        return; // Don't allow click if already running. 
    intervalId = setInterval(function() {
        START_TIMECOUNT++;
        TELEMETRY_COUNTER += PROCESS_SPEED;

        //Separater start
        if (SE_STATUS == 'R') {
            if (SYSTEM_CURRUNT_STATUS == 'S') {
                SYSTEM_CURRUNT_STATUS = 'A';
            }
            separatorOnOff(true);
        }

        //Separater off
        if (SE_STATUS == 'RS') {
            separatorOnOff(false);
        }

        var msg = '';
        if (TK204_OL > TK204_LL && TK204_OL < TK204_HL && TK201_OL > TK201_LLL && TK202_OL > TK202_LLL && TK201_OL > TK201_LL && TK202_OL > TK202_LL && TK205_OL > TK205_HL && TK205_OL > TK205_LL) {
            msg = '';
        } else {
            if (TK204_OL <= TK204_LL) {
                $('#lls-204').addClass("red");
                //var msg = msg + 'Reaction tank low level,';
            }
            if (TK204_OL >= TK204_HL) {
                var msg = msg + 'Reaction Tank High Level,';
                $('#hls-204').addClass("red");

            }
            if (TK201_OL <= TK201_LL && TK201_OL > TK201_LLL) {
                var msg = msg + 'Phosphoric acid tank low level,';
                $('#lls-201').addClass("red");
            }
            if (TK201_OL <= TK201_LLL) {
                var msg = msg + 'Process stopped,phosphoric acid tank empty,';
                $('#llls-201').addClass("red");
            }
            if (TK202_OL <= TK202_LL && TK202_OL > TK202_LLL) {
                var msg = msg + 'Caustic tank low level,';
                $('#lls-202').addClass("red");
            }
            if (TK202_OL <= TK202_LLL) {
                var msg = msg + 'Process stopped,caustic tank empty,';
                $('#llls-202').addClass("red");
            }
            if (TK205_OL >= TK205_HL) {
                //var msg = msg + 'Hevay phase tank low level';
                $('#hls-205').addClass("red");
            }
            if (TK205_OL <= TK205_LL) {
                //var msg = msg + 'Hevay phase tank low level';
                $('#lls-205').addClass("red");
            }
        }
        alarmIndicater(msg, 'alarm-warrning');


        if (SYSTEM_CURRUNT_STATUS == 'S' || SYSTEM_CURRUNT_STATUS == 'A') {
            //If the Phosphoric tank(TK201) and Caustic tank(TK202) are not at low level and Reaction tank not high level(TK204)          
            if (LLS_201 || LLS_202)
            {
                I_001 = 'Stopped';
                I_003 = 'Dosing not ready';
                $("#path_indicator").css("background-color", "red");
                $('#B_001').addClass("deactivated");
                $('#B_002').addClass("deactivated");
                $('#B_003').addClass("deactivated");
                resetMixer('m-201');
                feedoil = false;

            } else if (HLS_204) {
                I_001 = 'Stopped';
                I_003 = 'No path';
                $("#path_indicator").css("background-color", "red");
                $('#B_001').addClass("deactivated");
                $('#B_002').addClass("deactivated");
                $('#B_003').addClass("deactivated");
                resetMixer('m-201');
                feedoil = false;
            } else {
                I_001 = 'Stopped';
                I_003 = 'System Ready';
                $("#path_indicator").css("background-color", "green");
                $('#B_001').removeClass("deactivated");
                $('#B_002').addClass("deactivated");
                $('#B_003').addClass("deactivated");
                resetMixer('m-201');
                feedoil = false;
            }

        } else if (SYSTEM_CURRUNT_STATUS == 'R') {
            if (LLS_201 || LLS_202)
            {
                I_001 = 'Stopped';
                I_003 = 'Dosing not ready';
                $("#path_indicator").css("background-color", "red");
                $('#B_001').addClass("deactivated");
                $('#B_002').addClass("deactivated");
                $('#B_003').addClass("deactivated");
                SYSTEM_CURRUNT_STATUS = 'A';
                resetMixer('m-201');
                feedoil = false;
            } else if (HLS_204) {
                I_001 = 'Stopped';
                I_003 = 'No path';
                $("#path_indicator").css("background-color", "red");
                $('#B_001').addClass("deactivated");
                $('#B_002').addClass("deactivated");
                $('#B_003').addClass("deactivated");
                SYSTEM_CURRUNT_STATUS = 'A';
                resetMixer('m-201');
                feedoil = false;
            } else {
                I_001 = 'Running';
                I_003 = '';
                $("#path_indicator").css("background-color", "green");
                $('#B_001').addClass("deactivated");
                $('#B_002').removeClass("deactivated");
                $('#B_003').removeClass("deactivated");
                (!feedoil ? changeMixer('m-201', 'pump-running') : '');
                feedoil = true;
            }

        } else {
            I_001 = 'Paused';
            I_003 = 'System Ready';
            $("#path_indicator").css("background-color", "green");
            $('#B_001').removeClass("deactivated");
            $('#B_002').removeClass("deactivated");
            $('#B_003').addClass("deactivated");
            feedoil = false;
        }
        I_001StatusIndicater();
        I_003MessageDisplay();


        if (SYSTEM_CURRUNT_STATUS == 'A' || SYSTEM_CURRUNT_STATUS == 'R')
        {

            var operate_time = PROCESS_SPEED * 1;
            if (SYSTEM_CURRUNT_STATUS == 'R') {
                feedOil(operate_time);
            }
            if (SE_STATUS == 'W') {
                separatorOperation(true, operate_time);
            } else {
                if (SYSTEM_CURRUNT_STATUS == 'A' && SE_STATUS != 'R') {
                    SYSTEM_CURRUNT_STATUS = 'S';
                }
                separatorOperation(false, operate_time);
            }
        }
        
        // Send telemetry every 5 simulated minutes
        if (TELEMETRY_COUNTER >= TELEMETRY_INTERVAL) {
            sendTelemetry();
            TELEMETRY_COUNTER = 0;
        }
    }, 1000);




    /*Start button click*/
    $('#B_001').click(function() {
        //If the Phosphoric tank(TK201) and Caustic tank(TK202) are not at low level and Reaction tank not high level(TK204)         
        if (!LLS_201 && !LLS_202 && !HLS_204)
        {
            SYSTEM_CURRUNT_STATUS = 'R';
        }
    })

    /*Shutdown button click*/
    $('#B_002').click(function() {
        SYSTEM_CURRUNT_STATUS = 'A';
        stop('');
    })

    /*Paused button click*/
    $('#B_003').click(function() {
        SYSTEM_CURRUNT_STATUS = 'P';
        pause();
    })
});

/*
 * @End Lakmal 
 * 
 */