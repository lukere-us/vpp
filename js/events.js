function runEvent(event) {
    reactionTankOperation('event', 0, TK204_OL_DEF);
    causticTankOperation('event', 0, TK202_OL_DEF);
    acidTankOperation('event', 0, TK201_OL_DEF);
    heavyPhaseEjection('event', 0, TK205_OL_DEF);

    //separator
    PV207_STATUS = 'OFF';
    SE_STATUS = 'S';
    $("#sep_time").text('(Separator OFF)');
    $("#separator_status").prop("disabled", false);
    $('#separator_status').prop('checked', false);
    SE_OFF_SHEDULE_TIME = 0;
    var operate_time = PROCESS_SPEED * 1;
    REACTION_TANK_EJE_STATUS = false;
    SE_ON_TIME = 0;
    SYSTEM_CURRUNT_STATUS = 'S';
    SE_LAST_PE_TIME = 0;
    SE_LAST_TE_TIME = 0;
    separatorOperation(true, operate_time);
    stop();

    if (event == 1) {//reaction tank high level
        TK204_OL = TK204_HL;
        reactionTankOperation('event', 0, TK204_OL);
    } else if (event == 2) {//reaction tank low level
        TK204_OL = TK204_LL;
        reactionTankOperation('event', 0, TK204_OL);
    } else if (event == 3) {//caustic tank  low level
        TK202_OL = TK202_LLL;
        causticTankOperation('event', 0, TK202_OL);
    } else if (event == 4) {//acid tank  low level
        TK201_OL = TK201_LLL;
        acidTankOperation('event', 0, TK201_OL);
    } else if (event == 5) {//reaction tank  set level
        TK204_OL = TK204_SL;
        reactionTankOperation('event', 0, TK204_OL);
    } else if (event == 6) {//heavy Phase tank  high level
        TK205_OL = TK205_HL;
        ejecton('event', 0, TK205_OL);
    } else if (event == 7) {//heavy Phase tank  low level
        TK205_OL = TK205_LL;
        heavyPhaseEjection('event', 0, TK205_OL);
    } else if (event == 8) {//heavy Phase tank  low level
        PV207_STATUS = 'D';
        SE_STATUS = 'W';
        $("#sep_time").text('(Separator ON)');
        $("#sep_time").css("display", "block");
        $('#separator_status').prop('checked', true)
        $("#separator_status").prop("disabled", false);
        var operate_time = PROCESS_SPEED * 1;
        TK204_OL = TK204_SL;
        REACTION_TANK_EJE_STATUS = true;
        SE_ON_TIME = CURRUNT_TIME_SECONDS - 900;
        SYSTEM_CURRUNT_STATUS = 'R';
        SE_LAST_PE_TIME = CURRUNT_TIME_SECONDS;
        SE_LAST_TE_TIME = CURRUNT_TIME_SECONDS;
        reactionTankOperation('event', 0, TK204_OL);
        separatorOperation('event', operate_time);
    }

}

