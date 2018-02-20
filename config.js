var baseHost = window.location.hostname;
var baseEndpoint = 'http://' + baseHost;




function BaseViewModel(defaults, remoteUrl, mappings = {}) {
    var self = this;
    self.remoteUrl = remoteUrl;

    // Observable properties
    ko.mapping.fromJS(defaults, mappings, self);
    self.fetching = ko.observable(false);
}

BaseViewModel.prototype.update = function (after = function () {}) {
    var self = this;
    self.fetching(true);
    $.get(self.remoteUrl, function (data) {
        ko.mapping.fromJS(data, self);
    }, 'json').always(function () {
        self.fetching(false);
        after();
    });
};





function StatusViewModel() {
    var self = this;

    BaseViewModel.call(self, {
        "time_h": 0,
        "time_m": 0,
        "date_d": 0,
        "date_m": 0,
        "date_w": 0,
        "date_y": 0,
        //----------------
        "R0": 1,
        "R1": 0,
        "R2": 0,
        "R3": 0,
        //----------------
        "A0": 5,
        "A1": 4,
        "A2": 8,
        "A3": 11,
        //----------------
        "P0": 1,
        "P1": 0,
        "P2": 1,
        "P3": 0,
        //----------------
        "tCPU": 41.5,
        "ip": "10.116.1.13",
        "mqtt_status": true
    }, baseEndpoint + '/status');
    // Some devired values
    self.showTime = ko.pureComputed(function () {
        var out = '';
        if (self.time_h() < 10)
            out += '0';
        out += self.time_h();
        out += ':';
        if (self.time_m() < 10)
            out += '0';
        out += self.time_m();
        return out;
    });

    self.showDate = ko.pureComputed(function () {
        var out = '';
        var mnt = ["JANUARY", "FEBRUARY", "MARCH", "APRIL", "MAY", "JUNE", "JULY", "AUGUST", "SEPTEMBER", "OCTOBER", "NOVEMBER", "DECEMBER"];
        var dow = ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"];
        out += dow[self.date_w()];
        out += ', ';
        out += self.date_d();
        out += ' ';
        out += mnt[self.date_m()];
        out += ' ';
        out += self.date_y();
        return out;
    });
}
StatusViewModel.prototype = Object.create(BaseViewModel.prototype);
StatusViewModel.prototype.constructor = StatusViewModel;

function TZViewModel() {
    var self = this;
    BaseViewModel.call(self, {
        "zones": ["GMT", "GMT+0", "GMT+1", "GMT+2", "GMT+3", "GMT+4", "GMT+5", "GMT+6", "GMT+7", "GMT+8", "GMT+9", "GMT0", "GMT-0", "GMT-1", "GMT-2", "GMT-3", "GMT-4", "GMT-5", "GMT-6", "GMT-7", "GMT-8", "GMT-9", "GMT-10"]
    }, baseEndpoint + '/tz');
}
TZViewModel.prototype = Object.create(BaseViewModel.prototype);
TZViewModel.prototype.constructor = TZViewModel;

function ModbusViewModel() {
    BaseViewModel.call(this, {
        "modbus_enable": true,
        "modbus_address_mode": ["Standart", "nonstandart"],
        "modbus_address_mode_select": 0,
        "modbus_address": 1,
        "modbus_16bit_reg_address": 40001,
        "modbus_32bit_enable": true,
        "modbus_calc": ["raw data", "ieee754"],
        "modbus_calc_select": 1,
        "modbus_data": [["Voltage", 40001, true, 1, "V", 0], ["Current", 40003, false, 0, "A", 0], ["Power", 40005, true, 0, "W", 0], ["Energy", 40007, true, 0, "Wh", 0]]
    }, baseEndpoint + '/modbus');
}
ModbusViewModel.prototype = Object.create(BaseViewModel.prototype);
ModbusViewModel.prototype.constructor = ModbusViewModel;

function TempViewModel() {
    BaseViewModel.call(this, {
        "in_vars": ["DI_0", "DI_1", "DI_2", "DI_3", "T0"]
    }, baseEndpoint + '/temp');
}
TempViewModel.prototype = Object.create(BaseViewModel.prototype);
TempViewModel.prototype.constructor = TempViewModel;

function ConfigViewModel() {
    BaseViewModel.call(this, {
        "R0E": true,
        "R0P": false,
        "R0N": "Pump",
        "R1E": false,
        "R1P": true,
        "R1N": "empty",
        "R2E": true,
        "R2P": false,
        "R2N": "empty",
        "R3E": true,
        "R3P": false,
        "R3N": "empty",
        //------------------------------
        "A0E": true,
        "A0U": "Bar",
        "A0MIN": 0,
        "A0MAX": 10,
        "A0AMIN": 5,
        "A0AMAX": 8,
        "A0A": true,
        "A0N": "Pressure",
        "A1E": true,
        "A1U": "",
        "A1MIN": 0,
        "A1MAX": 0,
        "A1AMIN": 5,
        "A1AMAX": 8,
        "A1A": true,
        "A1N": "",
        "A2E": false,
        "A2U": "",
        "A2MIN": 0,
        "A2MAX": 0,
        "A2AMIN": 0,
        "A2AMAX": 0,
        "A2A": true,
        "A2N": "",
        "A3E": false,
        "A3U": "",
        "A3MIN": 0,
        "A3MAX": 0,
        "A3AMIN": 1200,
        "A3AMAX": 1245,
        "A3A": true,
        "A3N": "",
        //------------------------------
        "P0E": true,
        "P0P": true,
        "P0N": "Test",
        "P1E": false,
        "P1P": false,
        "P1N": "empty",
        "P2E": false,
        "P2P": false,
        "P2N": "empty",
        "P3E": true,
        "P3P": false,
        "P3N": "empty",
        //------------------------------
        "wuser": "",
        "wpass": "",
        "wpass2": "",
        //------------------------------
        "mqtt_enable": true,
        "mqtt_server": "",
        "mqtt_topic": "Eagle",
        "mqtt_feed_prefix": "test",
        "mqtt_ssl": true,
        "mqtt_user": "",
        "mqtt_pass": "",
        "mqtt_interval": 5,
        "mqtt_port": 1883,
        "mqtt_cert": "test.cert",
        "mqtt_key": "test.key",
        "mqtt_ssl": true,
        "mqtt_nods": [["A0", "0x7984719247", "Voltage"], ["R1", "0x7984711147", "New"]],
        //------------------------------
        "tzone": "GMT+4",
    }, baseEndpoint + '/config');
}
ConfigViewModel.prototype = Object.create(BaseViewModel.prototype);
ConfigViewModel.prototype.constructor = ConfigViewModel;

function TVViewModel() {
    BaseViewModel.call(this, {
            "Interval": 5,
            //DO
            "DO": [["Motor", true], ["Ch. 1", false], ["Alarm", false], ["Lamp", true]],
            //DI
            "DI": [["E-STOP", true], ["Sensor 1", true], ["Sensor 2", false], ["Switch", true]],
            //AI
            "AI": [["Temperature", true], ["Presurre", false], ["Sensor 1", false], ["Sensor 2", true]]
        },
        baseEndpoint + '/tv');
}
TVViewModel.prototype = Object.create(BaseViewModel.prototype);
TVViewModel.prototype.constructor = TVViewModel;


function OrangeViewModel() {
    var self = this;

    self.config = new ConfigViewModel();
    self.status = new StatusViewModel();
    self.tz = new TZViewModel();
    self.tv = new TVViewModel();
    self.modbus = new ModbusViewModel();
    self.temp = new TempViewModel();

    self.initialised = ko.observable(false);
    self.updating = ko.observable(false);

    var updateTimer = null;
    var updateTime = 1 * 1000;



    // -----------------------------------------------------------------------
    // Initialise the app
    // -----------------------------------------------------------------------
    self.start = function () {
        self.updating(true);
        self.temp.update(function () {
            self.modbus.update(function () {
                self.tv.update(function () {
                    self.tz.update(function () {
                        self.config.update(function () {
                            self.status.update(function () {
                                self.initialised(true);
                                updateTimer = setTimeout(self.update, updateTime);
                                self.updating(false);
                            });
                        });
                    });
                });
            });
        });
    };

    // -----------------------------------------------------------------------
    // Get the updated state from the ORANGE
    // -----------------------------------------------------------------------
    self.update = function () {
        if (self.updating()) {
            return;
        }
        self.updating(true);
        if (null !== updateTimer) {
            clearTimeout(updateTimer);
            updateTimer = null;
        }
        self.status.update(function () {
            updateTimer = setTimeout(self.update, updateTime);
            self.updating(false);
        });
    };

    // -----------------------------------------------------------------------
    // Event: BTN0
    // -----------------------------------------------------------------------
    self.BTN0Fetching = ko.observable(false);
    self.BTN0Success = ko.observable(false);
    self.BTN0 = function () {
        if (confirm('Switch ' + self.config.R0N() + ' ' + (self.status.R0() ? 'OFF' : 'ON'))) {
            self.BTN0Fetching(true);
            self.BTN0Success(false);
            $.post(baseEndpoint + "/btn0", function (data) {
                self.BTN0Success(true);
            }).fail(function () {
                alert("Relay 0 Failed!");
            }).always(function () {
                self.BTN0Fetching(false);
            });
        }
    };
    // -----------------------------------------------------------------------
    // Event: BTN1
    // -----------------------------------------------------------------------
    self.BTN1Fetching = ko.observable(false);
    self.BTN1Success = ko.observable(false);
    self.BTN1 = function () {
        self.BTN1Fetching(true);
        self.BTN1Success(false);
        $.post(baseEndpoint + "/btn1", function (data) {
            self.BTN1Success(true);
        }).fail(function () {
            alert("Relay 1 Failed!");
        }).always(function () {
            self.BTN1Fetching(false);
        });
    };
    // -----------------------------------------------------------------------
    // Event: BTN2
    // -----------------------------------------------------------------------
    self.BTN2Fetching = ko.observable(false);
    self.BTN2Success = ko.observable(false);
    self.BTN2 = function () {
        self.BTN2Fetching(true);
        self.BTN2Success(false);
        $.post(baseEndpoint + "/btn2", function (data) {
            self.BTN2Success(true);
        }).fail(function () {
            alert("Relay 2 Failed!");
        }).always(function () {
            self.BTN2Fetching(false);
        });
    };
    // -----------------------------------------------------------------------
    // Event: BTN3
    // -----------------------------------------------------------------------
    self.BTN3Fetching = ko.observable(false);
    self.BTN3Success = ko.observable(false);
    self.BTN3 = function () {
        self.BTN3Fetching(true);
        self.BTN3Success(false);
        $.post(baseEndpoint + "/btn3", function (data) {
            self.BTN3Success(true);
        }).fail(function () {
            alert("Relay 3 Failed!");
        }).always(function () {
            self.BTN3Fetching(false);
        });
    };

    // -----------------------------------------------------------------------
    // Event: DO setup
    // -----------------------------------------------------------------------
    self.saveDOFetching = ko.observable(false);
    self.saveDOSuccess = ko.observable(false);
    self.saveDO = function () {
        var DO = {
            enabled0: self.config.R0E(),
            enabled1: self.config.R1E(),
            enabled2: self.config.R2E(),
            enabled3: self.config.R3E(),
            label0: self.config.R0N(),
            label1: self.config.R1N(),
            label2: self.config.R2N(),
            label3: self.config.R3N(),
            pol0: self.config.R0P(),
            pol1: self.config.R1P(),
            pol2: self.config.R2P(),
            pol3: self.config.R3P()
        };
        self.saveDOFetching(true);
        self.saveDOSuccess(false);
        $.post(baseEndpoint + "/save_do", DO, function (data) {
            self.saveAISuccess(true);
        }).fail(function () {
            alert("Failed to save Relay Channels config");
        }).always(function () {
            self.saveDOFetching(false);
        });

    };
    // -----------------------------------------------------------------------
    // Event: DI setup
    // -----------------------------------------------------------------------
    self.saveDIFetching = ko.observable(false);
    self.saveDISuccess = ko.observable(false);
    self.saveDI = function () {
        var DI = {
            enabled0: self.config.P0E(),
            enabled1: self.config.P1E(),
            enabled2: self.config.P2E(),
            enabled3: self.config.P3E(),
            label0: self.config.P0N(),
            label1: self.config.P1N(),
            label2: self.config.P2N(),
            label3: self.config.P3N(),
            pol0: self.config.P0P(),
            pol1: self.config.P1P(),
            pol2: self.config.P2P(),
            pol3: self.config.P3P()
        };
        self.saveDIFetching(true);
        self.saveDISuccess(false);
        $.post(baseEndpoint + "/save_di", DI, function (data) {
            self.saveAISuccess(true);
        }).fail(function () {
            alert("Failed to save Digital Input Channels config");
        }).always(function () {
            self.saveDIFetching(false);
        });

    };
    // -----------------------------------------------------------------------
    // Event: AI setup
    // -----------------------------------------------------------------------
    self.saveAIFetching = ko.observable(false);
    self.saveAISuccess = ko.observable(false);
    self.saveAI = function () {
        var AI = {
            enabled0: self.config.A0E(),
            enabled1: self.config.A1E(),
            enabled2: self.config.A2E(),
            enabled3: self.config.A3E(),
            label0: self.config.A0N(),
            label1: self.config.A1N(),
            label2: self.config.A2N(),
            label3: self.config.A3N(),
            unit0: self.config.A0U(),
            unit1: self.config.A1U(),
            unit2: self.config.A2U(),
            unit3: self.config.A3U(),
            min_n0: self.config.A0MIN(),
            min_n1: self.config.A1MIN(),
            min_n2: self.config.A2MIN(),
            min_n3: self.config.A3MIN(),
            max_n0: self.config.A0MAX(),
            max_n1: self.config.A1MAX(),
            max_n2: self.config.A2MAX(),
            max_n3: self.config.A3MAX(),
            alarm0: self.config.A0A(),
            alarm1: self.config.A1A(),
            alarm2: self.config.A2A(),
            alarm3: self.config.A3A(),
            a_min_n0: self.config.A0AMIN(),
            a_min_n1: self.config.A1AMIN(),
            a_min_n2: self.config.A2AMIN(),
            a_min_n3: self.config.A3AMIN(),
            a_max_n0: self.config.A0AMAX(),
            a_max_n1: self.config.A1AMAX(),
            a_max_n2: self.config.A2AMAX(),
            a_max_n3: self.config.A3AMAX()
        };
        self.saveAIFetching(true);
        self.saveAISuccess(false);
        $.post(baseEndpoint + "/save_ai", AI, function (data) {
            self.saveAISuccess(true);
        }).fail(function () {
            alert("Failed to save Analog Channels config");
        }).always(function () {
            self.saveAIFetching(false);
        });

    };

    // -----------------------------------------------------------------------
    // Event: Admin save
    // -----------------------------------------------------------------------
    self.saveAdminFetching = ko.observable(false);
    self.saveAdminSuccess = ko.observable(false);
    self.saveAdmin = function () {
        var admin = {
            user: self.config.wuser(),
            pass: self.config.wpass()
        };
        if (admin.pass != self.config.wpass2()) {
            alert("Please enter simular password.");
        } else {
            self.saveAdminFetching(true);
            self.saveAdminSuccess(false);
            $.post(baseEndpoint + "/saveadmin", admin, function (data) {
                self.saveAdminSuccess(true);
            }).fail(function () {
                alert("Failed to save Access control config");
            }).always(function () {
                self.saveAdminFetching(false);
            });
        }
    };

    // -----------------------------------------------------------------------
    // Event: MQTT save
    // -----------------------------------------------------------------------
    self.saveMqttFetching = ko.observable(false);
    self.saveMqttSuccess = ko.observable(false);
    self.saveMqtt = function () {
        var mqtt = {
            enabled: self.config.mqtt_enable(),
            server: self.config.mqtt_server(),
            topic: self.config.mqtt_topic(),
            prefix: self.config.mqtt_feed_prefix(),
            ssl: self.config.mqtt_ssl(),
            user: self.config.mqtt_user(),
            pass: self.config.mqtt_pass(),
            interval: self.config.mqtt_interval(),
            port: self.config.mqtt_port()
        };

        if (mqtt.server === "") {
            alert("Please enter MQTT server");
        } else {
            self.saveMqttFetching(true);
            self.saveMqttSuccess(false);
            $.post(baseEndpoint + "/savemqtt", mqtt, function (data) {
                self.saveMqttSuccess(true);
            }).fail(function () {
                alert("Failed to save MQTT Report config");
            }).always(function () {
                self.saveMqttFetching(false);
            });
        }
    };
    // -----------------------------------------------------------------------
    // Event: TV Reports save
    // -----------------------------------------------------------------------
    self.saveTVFetching = ko.observable(false);
    self.saveTVSuccess = ko.observable(false);
    self.saveTV = function () {
        var TV = {
            interval: self.tv.Interval(),
            do0: self.tv.DO()[0][1],
            do1: self.tv.DO()[1][1],
            do2: self.tv.DO()[2][1],
            do3: self.tv.DO()[3][1],
            di0: self.tv.DI()[0][1],
            di1: self.tv.DI()[1][1],
            di2: self.tv.DI()[2][1],
            di3: self.tv.DI()[3][1],
            ai0: self.tv.AI()[0][1],
            ai1: self.tv.AI()[1][1],
            ai2: self.tv.AI()[2][1],
            ai3: self.tv.AI()[3][1]
        };
        self.saveTVFetching(true);
        self.saveTVSuccess(false);
        $.post(baseEndpoint + "/savetvr", TV, function (data) {
            self.saveTVSuccess(true);
        }).fail(function () {
            alert("Failed to save TV config");
        }).always(function () {
            self.saveTVFetching(false);
        });

    };

    // -----------------------------------------------------------------------
    // Event: TZ save
    // -----------------------------------------------------------------------
    self.saveTZFetching = ko.observable(false);
    self.saveTZSuccess = ko.observable(false);
    self.saveTZ = function () {
        if (self.config.tzone() === "") {
            alert("Please select Timezone");
        } else {
            self.saveTZFetching(true);
            self.saveTZSuccess(false);
            $.post(baseEndpoint + "/savetz", {
                timezone: self.config.tzone()
            }, function (data) {
                self.saveTZSuccess(true);
            }).fail(function () {
                alert("Failed to save Timezone config");
            }).always(function () {
                self.saveTZFetching(false);
            });
        }
    };
    // -----------------------------------------------------------------------
}
// -----------------------------------------------------------------------
$(function () {
    // Activates knockout.js
    var orange = new OrangeViewModel();
    ko.applyBindings(orange);
    orange.start();
});
// MENU FUNCTIONS---------------------------------------------------------
function dropdown() {
    var x = document.getElementById("config_menu");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}

function smallMenu() {
    var x = document.getElementById("small_menu");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}

// -----------------------------------------------------------------------
function relayDRAW(rVal) {
    if (rVal == 1)
        return 'images/relay_no.png';
    else
        return 'images/relay_nc.png';
}

function ledDRAW(rVal) {
    if (rVal == 1)
        return 'images/led_on.png';
    else
        return 'images/led_off.png';
}


function calcP(val, v_min, v_max) {
    return val / (v_max - v_min) * 100;
}
