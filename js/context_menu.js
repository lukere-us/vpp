
/*
 * 
 * @param validaton
 */

function validation(evt, number, min, max) {
    var valdation = true;
    if (number) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 31
                && (charCode < 48 || charCode > 57)) {
            valdation = false;
        }
    }
    if (min) {
        if (evt < min) {
            valdation = false;
        }
    }
    if (max) {
        if (evt > max) {
            valdation = false;
        }
    }
    return valdation;
}
//Allow numbers and decimal

/*
 * @RMC Phosphoric Acid Tank 
 */

$.contextMenu({
    selector: '#tk-201, #mix-201',
    zIndex: 10,
    items: {
        // <input type="text">
        name: {
            name: "Phosphoric Acid Tank Level % :",
            type: 'text',
            id: 'tk_201_level',
            value: TK201_OL,
            disabled: true,
        },
        name2: {
            name: "Set Low Level % :",
            type: 'text',
            id: 'tk_201_sll',
            value: TK201_LL,
        },
        name3: {
            name: "Set Low-Low Level % :",
            type: 'text',
            id: 'tk_201_slll',
            value: TK201_LLL,
        },
        key1: {
            name: "Fill Tank",
            callback: function(itemKey, opt) {
                acidTankFill();
                return true;
            }
        },
        key2: {
            name: "Change Value",
            callback: function(itemKey, opt) {
                $.each(opt.inputs, function(key, item) {
                    switch (item.id) {
                        case 'tk_201_sll':
                            TK201_LL = parseInt(item.$input.val());
                            item.value = TK201_LL;
                            break;
                        case 'tk_201_slll':
                            TK201_LLL = parseInt(item.$input.val());
                            item.value = TK201_LLL;
                            break;
                    }
                });
                return true;
            }
        }
    },
    events: {
        show: function(opt) {
            $.each(opt.inputs, function(key, item) {
                switch (item.id) {
                    case 'tk_201_level':
                        item.value = TK201_OL;
                        break;
                }
            });
        }
    }
}
);


/*
 * @RMC Caustic Tank 
 */

$.contextMenu({
    selector: '#tk-202, #mix-202',
    zIndex: 10,
    items: {
        // <input type="text">
        name: {
            name: "Caustic Tank Level % :",
            type: 'text',
            id: 'tk_202_level',
            value: TK202_OL,
            disabled: true,
        },
        name2: {
            name: "Set Low Level % :",
            type: 'text',
            id: 'tk_202_sll',
            value: TK202_LL,
        },
        name3: {
            name: "Set Low-Low Level % :",
            type: 'text',
            id: 'tk_202_slll',
            value: TK202_LLL,
        },
        key1: {
            name: "Fill Tank",
            callback: function(itemKey, opt) {
                causticTankFill();
                return true;
            }
        },
        key2: {
            name: "Change Value",
            callback: function(itemKey, opt) {
                $.each(opt.inputs, function(key, item) {
                    switch (item.id) {
                        case 'tk_202_sll':
                            TK202_LL = parseInt(item.$input.val());
                            item.value = TK202_LL;
                            break;
                        case 'tk_202_slll':
                            TK202_LLL = parseInt(item.$input.val());
                            item.value = TK202_LLL;
                            break;
                    }
                });
                return true;
            }
        }
    },
    events: {
        show: function(opt) {
            $.each(opt.inputs, function(key, item) {
                switch (item.id) {
                    case 'tk_202_level':
                        item.value = TK202_OL;
                        break;
                }
            });
        }
    }
}
);


/*
 * @RMC Reaction Tank(L204) 
 */

$.contextMenu({
    selector: '#tk-204, #mix-203',
    zIndex: 10,
    items: {
        // <input type="text">
        name1: {
            name: "High Level % :",
            type: 'text',
            id: 'tk_204_hl',
            value: TK204_HL,
            events: {
                keyup: function(e) {
                    return false;
                }
            }
        },
        name2: {
            name: "Set Level % :",
            type: 'text',
            id: 'tk_204_sl',
            value: TK204_SL,
        },
        name3: {
            name: "Low Level % :",
            type: 'text',
            id: 'tk_204_ll',
            value: TK204_LL,
        },
        key: {
            name: "Change Value",
            callback: function(itemKey, opt) {
                $.each(opt.inputs, function(key, item) {
                    switch (item.id) {
                        case 'tk_204_hl':
                            TK204_HL = parseInt(item.$input.val());
                            item.value = TK204_HL;
                            break;
                        case 'tk_204_sl':
                            TK204_SL = parseInt(item.$input.val());
                            item.value = TK204_SL;
                            break;
                        case 'tk_204_ll':
                            TK204_LL = parseInt(item.$input.val());
                            item.value = TK204_LL;
                            break;
                    }
                });
                return true;
            }
        }
    }
}
);

/*
 * @RMC Oil Flow Rate
 */
$.contextMenu({
    selector: '#oil_flow_rate',
    zIndex: 10,
    items: {
        // <input type="text">
        name1: {
            name: "Oil Flow Rate F201 Setpoint(LPH)",
            type: 'text',
            id: 'oil_flow_rate',
            value: F201_OP,
        },
        key: {
            name: "Change Value",
            callback: function(itemKey, opt) {
                $.each(opt.inputs, function(key, item) {
                    F201_OP = parseInt(item.$input.val());
                    item.value = F201_OP;
                    $('#F201_OP').text(F201_OP + ' Lt/H');

                });
                return true;
            }
        }
    }
}
);


/*
 * @RMC T201 temperature controller 
 */

$.contextMenu({
    selector: '#t-201-menu',
    zIndex: 10,
    items: {
        // <input type="text">
        name1: {
            name: "High Temp Cut-off :",
            type: 'text',
            id: 'tk_201_hl',
            value: T201_HL,
        },
        name2: {
            name: "Temp Setpoint :",
            type: 'text',
            id: 'tk_201_sp',
            value: T201_SP,
        },
        name3: {
            name: "Low Temp Cut-off:",
            type: 'text',
            id: 'tk_201_ll',
            value: T201_LL,
        },
        key: {
            name: "Change Value",
            callback: function(itemKey, opt) {
                $.each(opt.inputs, function(key, item) {
                    switch (item.id) {
                        case 'tk_201_hl':
                            T201_HL = parseInt(item.$input.val());
                            item.value = T201_HL;
                            break;
                        case 'tk_201_sp':
                            T201_SP = parseInt(item.$input.val());
                            item.value = T201_SP;
                            $("#T201_SP").text(T201_SP + ' C');
                            break;
                        case 'tk_201_ll':
                            T201_LL = parseInt(item.$input.val());
                            item.value = T201_LL;
                            break;
                    }
                });
                return true;
            }
        }
    }
}
);

/*
 * @RMC PV207
 */
$.contextMenu({
    selector: '#pv-207',
    items: {
        // <input type="text">
        radio1: {
            name: "Tank Farm",
            type: 'radio',
            radio: 'radio',
            value: 'TF',
            selected: (PV207_STATUS == 'TF' ? true : false)

        },
        radio2: {
            name: "Drying",
            type: 'radio',
            radio: 'radio',
            value: 'D',
            selected: (PV207_STATUS == 'D' ? true : false)

        },
        radio3: {
            name: "Off",
            type: 'radio',
            radio: 'radio',
            value: 'OFF',
            selected: (PV207_STATUS == 'OFF' ? true : false)
        },
        key: {
            name: "Change Value",
            callback: function(itemKey, opt) {
                $.each(opt.inputs, function(key, item) {
                    if (item.$input[0].checked) {
                        PV207_STATUS = item.$input[0].value;
                        item.selected = true;
                        if (PV207_STATUS == 'TF') {
                            valveOpenUp('pv-207');
                        } else if (PV207_STATUS == 'D') {
                            valveOpenDown('pv-207');
                        } else {
                            valveClosed('pv-207');
                        }
                    } else {
                        item.selected = false;
                    }


                });
                return true;
            }
        }
    }
}
);


/*
 * @RMC PV209
 */
$.contextMenu({
    selector: '#pv-209',
    items: {
        // <input type="text">
        name1: {
            name: "PV209 Flow Rate(LPH)",
            type: 'text',
            id: 'pv207_oil_flow_rate',
            value: PV209_FL,
        },
        key: {
            name: "Change Value",
            callback: function(itemKey, opt) {
                $.each(opt.inputs, function(key, item) {
                    PV209_FL = parseInt(item.$input.val());
                    item.value = PV209_FL;

                });
                return true;
            }
        }
    }
}
);

/*
 * @RMC PV205
 */
$.contextMenu({
    selector: '#p-205',
    zIndex: 10,
    items: {
        // <input type="text">
        name1: {
            name: "P205 Flow Rate(LPH)",
            type: 'text',
            id: 'p205_oil_flow_rate',
            value: PV205_FL,
        },
        key: {
            name: "Change Value",
            callback: function(itemKey, opt) {
                $.each(opt.inputs, function(key, item) {
                    PV205_FL = parseInt(item.$input.val());
                    item.value = PV205_FL;

                });
                return true;
            }
        }
    }
}
);


/*
 * @RMC Heavy Phase Tank(L205) 
 */

$.contextMenu({
    selector: '#tk-205, #mix-205',
    zIndex: 10,
    items: {
        // <input type="text">
        name1: {
            name: "High Level % :",
            type: 'text',
            id: 'tk_205_hl',
            value: TK205_HL,
        },
        name2: {
            name: "Set Level % :",
            type: 'text',
            id: 'tk_205_sl',
            value: TK205_SL,
        },
        name3: {
            name: "Low Level % :",
            type: 'text',
            id: 'tk_205_ll',
            value: TK205_LL,
        },
        key: {
            name: "Change Value",
            callback: function(itemKey, opt) {
                $.each(opt.inputs, function(key, item) {
                    switch (item.id) {
                        case 'tk_205_hl':
                            TK205_HL = parseInt(item.$input.val());
                            item.value = TK205_HL;
                            break;
                        case 'tk_205_sl':
                            TK205_SL = parseInt(item.$input.val());
                            item.value = TK205_SL;
                            break;
                        case 'tk_205_ll':
                            TK205_LL = parseInt(item.$input.val());
                            item.value = TK205_LL;
                            break;
                    }
                });
                return true;
            }
        }
    }
}
);


/*
 * @RMC separator controller) 
 */
$.contextMenu({
    selector: '#cs-201',
    zIndex: 10,
    items: {
        // <input type="text">
        name1: {
            name: "Total ejection interval(Min)",
            type: 'text',
            id: 'te_int',
            value: SE_TE_INT,
        },
        name2: {
            name: "Total ejection duration(Sec)",
            type: 'text',
            id: 'te_dur',
            value: SE_TE_D,
        },
        name3: {
            name: "Partial ejection interval(Sec)",
            type: 'text',
            id: 'pe_int',
            value: SE_PE_INT,
        },
        name4: {
            name: "Partial ejection duration(Sec)",
            type: 'text',
            id: 'pe_dur',
            value: SE_PE_D,
        },
        key1: {
            name: "Change Value",
            callback: function(itemKey, opt) {
                $.each(opt.inputs, function(key, item) {
                    switch (item.id) {
                        case 'te_int':
                            SE_TE_INT = parseInt(item.$input.val());
                            item.value = SE_TE_INT;
                            break;
                        case 'te_dur':
                            SE_TE_D = parseInt(item.$input.val());
                            item.value = SE_TE_D;
                            break;
                        case 'pe_int':
                            SE_PE_INT = parseInt(item.$input.val());
                            item.value = SE_PE_INT;
                            break;
                        case 'pe_dur':
                            SE_PE_D = parseInt(item.$input.val());
                            item.value = SE_PE_D;
                            break;
                    }
                });
                return true;
            }
        },
        key2: {
            name: "Total Ejection",
            callback: function(itemKey, opt) {
                manualTotalEjecton();
            }
        }
    }
}
);
