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
        "P3": 0
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

function ConfigViewModel() {
    BaseViewModel.call(this, {
        "R0E": true,
        "R0P": false,
        "R0N": "Pump",
        "R1E": true,
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
        "A1E": false,
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
        "P2E": true,
        "P2P": false,
        "P2N": "empty",
        "P3E": false,
        "P3P": false,
        "P3N": "empty",
        //------------------------------
        "wuser": "",
        "wpass": "",
        //------------------------------
        "emoncms_server": "",
        "emoncms_apikey": "",
        "emoncms_node": "",
        "emoncms_fingerprint": "",
        "emoncms_interval": 5,
        //------------------------------
        "mqtt_server": "",
        "mqtt_topic": "",
        "mqtt_feed_prefix": "",
        "mqtt_user": "",
        "mqtt_pass": "",
        "mqtt_interval": 5,
        "mqtt_port": 1883,
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

    self.initialised = ko.observable(false);
    self.updating = ko.observable(false);

    var updateTimer = null;
    var updateTime = 1 * 1000;



    // -----------------------------------------------------------------------
    // Initialise the app
    // -----------------------------------------------------------------------
    self.start = function () {
        self.updating(true);
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
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // RELAY CHANNELS CONFIG
    // -----------------------------------------------------------------------
    // Event: Relay 0 setup
    // -----------------------------------------------------------------------
    self.saveR0Fetching = ko.observable(false);
    self.saveR0Success = ko.observable(false);
    self.saveR0 = function () {
        var Relay0 = {
            label: self.config.R0N(),
            pol: self.config.R0P()
        };
        self.saveR0Fetching(true);
        self.saveR0Success(false);
        $.post(baseEndpoint + "/saver0", Relay0, function (data) {
            self.saveR0Success(true);
        }).fail(function () {
            alert("Failed to save Relay 0 config");
        }).always(function () {
            self.saveR0Fetching(false);
        });
    };
    // -----------------------------------------------------------------------
    // Event: Relay 1 setup
    // -----------------------------------------------------------------------
    self.saveR1Fetching = ko.observable(false);
    self.saveR1Success = ko.observable(false);
    self.saveR1 = function () {
        var Relay1 = {
            label: self.config.R1N(),
            pol: self.config.R1P()
        };
        self.saveR1Fetching(true);
        self.saveR1Success(false);
        $.post(baseEndpoint + "/saver1", Relay1, function (data) {
            self.saveR1Success(true);
        }).fail(function () {
            alert("Failed to save Relay 1 config");
        }).always(function () {
            self.saveR1Fetching(false);
        });

    };
    // -----------------------------------------------------------------------
    // Event: Relay 2 setup
    // -----------------------------------------------------------------------
    self.saveR2Fetching = ko.observable(false);
    self.saveR2Success = ko.observable(false);
    self.saveR2 = function () {
        var Relay2 = {
            label: self.config.R2N(),
            pol: self.config.R2P()
        };
        self.saveR2Fetching(true);
        self.saveR2Success(false);
        $.post(baseEndpoint + "/saver2", Relay2, function (data) {
            self.saveR2Success(true);
        }).fail(function () {
            alert("Failed to save Relay 2 config");
        }).always(function () {
            self.saveR2Fetching(false);
        });

    };
    // -----------------------------------------------------------------------
    // Event: DO setup
    // -----------------------------------------------------------------------
    self.saveDOFetching = ko.observable(false);
    self.saveDOSuccess = ko.observable(false);
    self.saveDO = function () {
        var DO = {
            enabled: [self.config.R0E(), self.config.R1E(), self.config.R2E(), self.config.R3E()],
            label: [self.config.R0N(), self.config.R1N(), self.config.R2N(), self.config.R3N()],
            pol: [self.config.R0P(), self.config.R1P(), self.config.R2P(), self.config.R3P()]
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
            enabled: [self.config.P0E(), self.config.P1E(), self.config.P2E(), self.config.P3E()],
            label: [self.config.P0N(), self.config.P1N(), self.config.P2N(), self.config.P3N()],
            pol: [self.config.P0P(), self.config.P1P(), self.config.P2P(), self.config.P3P()]
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
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ANALOG CHANNELS CONFIG
    // -----------------------------------------------------------------------
    // Event: AI setup
    // -----------------------------------------------------------------------
    self.saveAIFetching = ko.observable(false);
    self.saveAISuccess = ko.observable(false);
    self.saveAI = function () {
        var AI = {
            enabled: [self.config.A0E(), self.config.A1E(), self.config.A2E(), self.config.A3E()],
            label: [self.config.A0N(), self.config.A1N(), self.config.A2N(), self.config.A3N()],
            unit: [self.config.A0U(), self.config.A1U(), self.config.A2U(), self.config.A3U()],
            min_n: [self.config.A0MIN(), self.config.A1MIN(), self.config.A2MIN(), self.config.A3MIN()],
            max_n: [self.config.A0MAX(), self.config.A1MAX(), self.config.A2MAX(), self.config.A3MAX()],
            alarm: [self.config.A0A(), self.config.A1A(), self.config.A2A(), self.config.A3A()],
            a_min_n: [self.config.A0AMIN(), self.config.A1AMIN(), self.config.A2AMIN(), self.config.A3AMIN()],
            a_max_n: [self.config.A0AMAX(), self.config.A1AMAX(), self.config.A2AMAX(), self.config.A3AMAX()]
        };
        self.saveAIFetching(true);
        self.saveAISuccess(false);
        $.post(baseEndpoint + "/saveai", AI, function (data) {
            self.saveAISuccess(true);
        }).fail(function () {
            alert("Failed to save Analog Channels config");
        }).always(function () {
            self.saveAIFetching(false);
        });

    };
    // -----------------------------------------------------------------------
    // Event: AI 0 setup
    // -----------------------------------------------------------------------
    self.saveAI0Fetching = ko.observable(false);
    self.saveAI0Success = ko.observable(false);
    self.saveAI0 = function () {
        var AI0 = {
            label: self.config.A0N(),
            unit: self.config.A0U(),
            min_n: self.config.A0MIN(),
            max_n: self.config.A0MAX()
        };
        self.saveAI0Fetching(true);
        self.saveAI0Success(false);
        $.post(baseEndpoint + "/saveai0", AI0, function (data) {
            self.saveAI0Success(true);
        }).fail(function () {
            alert("Failed to save Analog Channel 0 config");
        }).always(function () {
            self.saveAI0Fetching(false);
        });

    };
    // -----------------------------------------------------------------------
    // Event: AI 1 setup
    // -----------------------------------------------------------------------
    self.saveAI1Fetching = ko.observable(false);
    self.saveAI1Success = ko.observable(false);
    self.saveAI1 = function () {
        var AI1 = {
            label: self.config.A1N(),
            unit: self.config.A1U(),
            min_n: self.config.A1MIN(),
            max_n: self.config.A1MAX()
        };
        self.saveAI1Fetching(true);
        self.saveAI1Success(false);
        $.post(baseEndpoint + "/saveai1", AI1, function (data) {
            self.saveAI1Success(true);
        }).fail(function () {
            alert("Failed to save Analog Channel 1 config");
        }).always(function () {
            self.saveAI1Fetching(false);
        });

    };
    // -----------------------------------------------------------------------
    // Event: AI 2 setup
    // -----------------------------------------------------------------------
    self.saveAI2Fetching = ko.observable(false);
    self.saveAI2Success = ko.observable(false);
    self.saveAI2 = function () {
        var AI2 = {
            label: self.config.A2N(),
            unit: self.config.A2U(),
            min_n: self.config.A2MIN(),
            max_n: self.config.A2MAX()
        };
        self.saveAI2Fetching(true);
        self.saveAI2Success(false);
        $.post(baseEndpoint + "/saveai2", AI2, function (data) {
            self.saveAI2Success(true);
        }).fail(function () {
            alert("Failed to save Analog Channel 2 config");
        }).always(function () {
            self.saveAI2Fetching(false);
        });

    };
    // -----------------------------------------------------------------------
    // Event: AI 3 setup
    // -----------------------------------------------------------------------
    self.saveAI3Fetching = ko.observable(false);
    self.saveAI3Success = ko.observable(false);
    self.saveAI3 = function () {
        var AI3 = {
            label: self.config.A3N(),
            unit: self.config.A3U(),
            min_n: self.config.A3MIN(),
            max_n: self.config.A3MAX()
        };
        self.saveAI3Fetching(true);
        self.saveAI3Success(false);
        $.post(baseEndpoint + "/saveai3", AI3, function (data) {
            self.saveAI3Success(true);
        }).fail(function () {
            alert("Failed to save Analog Channel 3 config");
        }).always(function () {
            self.saveAI3Fetching(false);
        });

    };
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // INPUT CHANNELS CONFIG
    // -----------------------------------------------------------------------
    // Event: Input 0 setup
    // -----------------------------------------------------------------------
    self.saveP0Fetching = ko.observable(false);
    self.saveP0Success = ko.observable(false);
    self.saveP0 = function () {
        var Pin0 = {
            label: self.config.P0N(),
            pol: self.config.P0P()
        };
        self.saveP0Fetching(true);
        self.saveP0Success(false);
        $.post(baseEndpoint + "/savep0", Pin0, function (data) {
            self.saveP0Success(true);
        }).fail(function () {
            alert("Failed to save Input 0 config");
        }).always(function () {
            self.saveP0Fetching(false);
        });

    };
    // -----------------------------------------------------------------------
    // Event: Input 1 setup
    // -----------------------------------------------------------------------
    self.saveP1Fetching = ko.observable(false);
    self.saveP1Success = ko.observable(false);
    self.saveP1 = function () {
        var Pin1 = {
            label: self.config.P1N(),
            pol: self.config.P1P()
        };
        self.saveP1Fetching(true);
        self.saveP1Success(false);
        $.post(baseEndpoint + "/savep1", Pin1, function (data) {
            self.saveP1Success(true);
        }).fail(function () {
            alert("Failed to save Input 1 config");
        }).always(function () {
            self.saveP1Fetching(false);
        });

    };
    // -----------------------------------------------------------------------
    // Event: Input 2 setup
    // -----------------------------------------------------------------------
    self.saveP2Fetching = ko.observable(false);
    self.saveP2Success = ko.observable(false);
    self.saveP2 = function () {
        var Pin2 = {
            label: self.config.P2N(),
            pol: self.config.P2P()
        };
        self.saveP2Fetching(true);
        self.saveP2Success(false);
        $.post(baseEndpoint + "/savep2", Pin2, function (data) {
            self.saveP2Success(true);
        }).fail(function () {
            alert("Failed to save Input 2 config");
        }).always(function () {
            self.saveP2Fetching(false);
        });

    };
    // -----------------------------------------------------------------------
    // Event: Input 3 setup
    // -----------------------------------------------------------------------
    self.saveP3Fetching = ko.observable(false);
    self.saveP3Success = ko.observable(false);
    self.saveP3 = function () {
        var Pin3 = {
            label: self.config.P3N(),
            pol: self.config.P3P()
        };
        self.saveP3Fetching(true);
        self.saveP3Success(false);
        $.post(baseEndpoint + "/savep3", Pin3, function (data) {
            self.saveP3Success(true);
        }).fail(function () {
            alert("Failed to save Input 3 config");
        }).always(function () {
            self.saveP3Fetching(false);
        });

    };


    // -----------------------------------------------------------------------
    // Event: Admin save
    // -----------------------------------------------------------------------
    self.saveAdminFetching = ko.observable(false);
    self.saveAdminSuccess = ko.observable(false);
    self.saveAdmin = function () {
        self.saveAdminFetching(true);
        self.saveAdminSuccess(false);
        $.post(baseEndpoint + "/saveadmin", {
            user: self.config.wuser(),
            pass: self.config.wpass()
        }, function (data) {
            self.saveAdminSuccess(true);
        }).fail(function () {
            alert("Failed to save Access control config");
        }).always(function () {
            self.saveAdminFetching(false);
        });
    };
    // -----------------------------------------------------------------------
    // Event: Emoncms save
    // -----------------------------------------------------------------------
    self.saveEmonCmsFetching = ko.observable(false);
    self.saveEmonCmsSuccess = ko.observable(false);
    self.saveEmonCms = function () {
        var emoncms = {
            server: self.config.emoncms_server(),
            apikey: self.config.emoncms_apikey(),
            node: self.config.emoncms_node(),
            fingerprint: self.config.emoncms_fingerprint()
        };

        if (emoncms.server === "" || emoncms.node === "") {
            alert("Please enter Emoncms server and node");
        } else if (emoncms.apikey.length != 32) {
            alert("Please enter valid Emoncms apikey");
        } else if (emoncms.fingerprint !== "" && emoncms.fingerprint.length != 59) {
            alert("Please enter valid SSL SHA-1 fingerprint");
        } else {
            self.saveEmonCmsFetching(true);
            self.saveEmonCmsSuccess(false);
            $.post(baseEndpoint + "/saveemoncms", emoncms, function (data) {
                self.saveEmonCmsSuccess(true);
            }).fail(function () {
                alert("Failed to save Admin config");
            }).always(function () {
                self.saveEmonCmsFetching(false);
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
            server: self.config.mqtt_server(),
            topic: self.config.mqtt_topic(),
            prefix: self.config.mqtt_feed_prefix(),
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
