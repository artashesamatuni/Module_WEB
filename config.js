var baseHost = window.location.hostname;
//var baseHost = '10.116.1.13';
var baseEndpoint = 'http://' + baseHost;

var r_node = -1;




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
        "enable": true,
        "baud_rate": 9600,
        "parity": "none",
        "stop_bits": 1,
        "data_bits": 8,
        "read_interval": 15,
        "read_timeout": 1,
        "dev_list": [["test1", 11, 22, "Holding register", "a", 0.05, 4, true, true, true], ["test5", 111, 222, "Input register", "a", .11, .25, true, false, false]]
    }, baseEndpoint + '/modbus');
}
ModbusViewModel.prototype = Object.create(BaseViewModel.prototype);
ModbusViewModel.prototype.constructor = ModbusViewModel;


function NConfigViewModel() {
    BaseViewModel.call(this, {
        "dhcp": false,
        "ip": "10.116.1.13",
        "nm": "255.255.255.0",
        "gw": "10.116.1.1",
        "br": "10.116.1.1",
        "dns": "8.8.8.8",
        "dom": "eaglemon.com",
        "sr": "eaglemon.com"
    }, baseEndpoint + '/nconfig');
}
NConfigViewModel.prototype = Object.create(BaseViewModel.prototype);
NConfigViewModel.prototype.constructor = NConfigViewModel;


function ConfigViewModel() {
    BaseViewModel.call(this, {
        "R0E": true,
        "R0P": false,
        "R0N": "Pump",
        "R0M": 0,
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
        "A0MIN": -30,
        "A0MAX": 8,
        "A0AMIN": -20,
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
        "P0M": 1,
        "P0SR": 1000,
        "P0IC": 200,
        "P0PV": 0.25,
        "P0CD": 1,
        "P0CE": 1,
        "P0U": "10x",
        "P0MAXIR": 1000000,
        "P0MINIR": 10,
        "P0R": true,
        "P1E": true,
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
        "mqtt_ca": "test.crt",
        "mqtt_nods": [["A00000000000000000", "aaa"], ["R1", "0x7984711147"]],
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
    self.nconfig = new NConfigViewModel();
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
        self.nconfig.update(function () {
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
    self.saveMQTTFetching = ko.observable(false);
    self.saveMQTTSuccess = ko.observable(false);
    self.saveMQTT = function () {
        var Mqtt = {
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


        if ((self.config.mqtt_topic() === "" || self.config.mqtt_server() === "") && self.config.mqtt_enable()) {
            alert("MQTT Server or Topic can not be empty.");

        } else {
            self.saveMQTTFetching(true);
            self.saveMQTTSuccess(false);
            $.post(baseEndpoint + "/savemqtt", Mqtt, function (data) {
                self.saveMQTTSuccess(true);
            }).fail(function () {
                alert("Failed to save MQTT Report Config.");
            }).always(function () {
                self.saveMQTTFetching(false);
            });
        }

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
                alert("Failed to save Timezone config.");
            }).always(function () {
                self.saveTZFetching(false);
            });
        }
    };
    // -----------------------------------------------------------------------
    // Event: NET setup
    // -----------------------------------------------------------------------
    self.saveNETFetching = ko.observable(false);
    self.saveNETSuccess = ko.observable(false);
    self.saveNET = function () {
        var NET = {
            dhcp: self.nconfig.dhcp(),
            ip: self.nconfig.ip(),
            nm: self.nconfig.nm(),
            gw: self.nconfig.gw(),
            br: self.nconfig.br(),
            dns: self.nconfig.dns(),
            dom: self.nconfig.dom(),
            sr: self.nconfig.sr()
        };
        if (self.nconfig.dhcp()) {
            self.saveNETFetching(true);
            self.saveNETSuccess(false);
            $.post(baseEndpoint + "/save_net", NET, function (data) {
                self.saveNETSuccess(true);
            }).fail(function () {
                alert("Failed to save Dynamic Network Settings");
            }).always(function () {
                self.saveNETFetching(false);
            });
        } else {
            if (self.nconfig.ip() === "") {
                alert("IP Address can not be empty.");
            } else
            if (self.nconfig.nm() === "") {
                alert("Netmask can not be empty.");
            } else
            if (self.nconfig.gw() === "") {
                alert("Gateway can not be empty.");
            } else {
                self.saveNETFetching(true);
                self.saveNETSuccess(false);
                $.post(baseEndpoint + "/save_net", NET, function (data) {
                    self.saveNETSuccess(true);
                }).fail(function () {
                    alert("Failed to save Static Network Settings");
                }).always(function () {
                    self.saveNETFetching(false);
                });
            }
        }

    };


    // -----------------------------------------------------------------------
    // Event: Modbus save
    // -----------------------------------------------------------------------
    self.saveMBUSFetching = ko.observable(false);
    self.saveMBUSSuccess = ko.observable(false);
    self.saveMBUS = function () {
        var MBUS = {
            mbus_enabled: self.modbus.enable(),
            baud_rate: self.modbus.baud_rate(),
            parity: self.modbus.parity(),
            stop_bits: self.modbus.stop_bits(),
            data_bits: self.modbus.data_bits(),
            read_interval: self.modbus.read_interval(),
            read_timeout: self.modbus.read_timeout()
        };
        self.saveTZFetching(true);
        self.saveTZSuccess(false);
        $.post(baseEndpoint + "/save_mbus", MBUS, function (data) {
            self.saveMBUSSuccess(true);
        }).fail(function () {
            alert("Failed to save Modbus config.");
        }).always(function () {
            self.saveMBUSFetching(false);
        });
    };

    // -----------------------------------------------------------------------
    // Event: Modbus node remove
    // -----------------------------------------------------------------------
    self.delMBUSFetching = ko.observable(false);
    self.delMBUSSuccess = ko.observable(false);
    self.delMBUS = function () {

        if (r_node === -1) {
            alert("Please select node");
        } else {
            self.delMBUSFetching(true);
            self.delMBUSSuccess(false);
            $.post(baseEndpoint + "/del_mbus", {
                addr: r_node
            }, function (data) {
                self.delMBUSSuccess(true);
            }).fail(function () {
                alert("Failed to delete device node.");
            }).always(function () {
                self.delMBUSFetching(false);
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
//-----------------------------------------------------------------------
function R0Menu() {
    var x = document.getElementById("t0");
    if (x.className.indexOf("w3-show") == -1) {
        x.className = " w3-show";
        document.getElementById("b0").className = "w3-button w3-block w3-light-gray w3-border-right w3-border-left w3-border-top";
        document.getElementById("b1").className = "w3-button w3-block w3-light-gray w3-border-right w3-border-top w3-border-bottom";
        document.getElementById("b2").className = "w3-button w3-block w3-light-gray w3-border-right w3-border-top w3-border-bottom";
        document.getElementById("b3").className = "w3-button w3-block w3-light-gray w3-border-right w3-border-top w3-border-bottom";
        document.getElementById("t1").className = "w3-hide";
        document.getElementById("t2").className = "w3-hide";
        document.getElementById("t3").className = "w3-hide";
    }
}

function R1Menu() {
    var x = document.getElementById("t1");
    if (x.className.indexOf("w3-show") == -1) {
        x.className = " w3-show";
        document.getElementById("b0").className = "w3-button w3-block w3-light-gray w3-border-right w3-border-left w3-border-top w3-border-bottom";
        document.getElementById("b1").className = "w3-button w3-block w3-light-gray w3-border-right w3-border-top";
        document.getElementById("b2").className = "w3-button w3-block w3-light-gray w3-border-right w3-border-top w3-border-bottom";
        document.getElementById("b3").className = "w3-button w3-block w3-light-gray w3-border-right w3-border-top w3-border-bottom";
        document.getElementById("t0").className = "w3-hide";
        document.getElementById("t2").className = "w3-hide";
        document.getElementById("t3").className = "w3-hide";
    }
}

function R2Menu() {
    var x = document.getElementById("t2");
    if (x.className.indexOf("w3-show") == -1) {
        x.className = " w3-show";
        document.getElementById("b0").className = "w3-button w3-block w3-light-gray w3-border-right w3-border-left w3-border-top w3-border-bottom";
        document.getElementById("b1").className = "w3-button w3-block w3-light-gray w3-border-right w3-border-top w3-border-bottom";
        document.getElementById("b2").className = "w3-button w3-block w3-light-gray w3-border-right w3-border-top";
        document.getElementById("b3").className = "w3-button w3-block w3-light-gray w3-border-right w3-border-top w3-border-bottom";
        document.getElementById("t0").className = "w3-hide";
        document.getElementById("t1").className = "w3-hide";
        document.getElementById("t3").className = "w3-hide";
    }
}

function R3Menu() {
    var x = document.getElementById("t3");
    if (x.className.indexOf("w3-show") == -1) {
        x.className = " w3-show";
        document.getElementById("b0").className = "w3-button w3-block w3-light-gray w3-border-right w3-border-left w3-border-top w3-border-bottom";
        document.getElementById("b1").className = "w3-button w3-block w3-light-gray w3-border-right w3-border-top w3-border-bottom";
        document.getElementById("b2").className = "w3-button w3-block w3-light-gray w3-border-right w3-border-top w3-border-bottom";
        document.getElementById("b3").className = "w3-button w3-block w3-light-gray w3-border-right w3-border-top";
        document.getElementById("t0").className = "w3-hide";
        document.getElementById("t1").className = "w3-hide";
        document.getElementById("t2").className = "w3-hide";
    }
}




function ff() {
    var x = document.createElement("INPUT");
    x.setAttribute("type", "file");
    document.getElementById("cert_f").appendChild(x);
    var y = document.createElement("INPUT");
    y.setAttribute("type", "submit");
    y.setAttribute("name", "update");
    y.setAttribute("value", "Update");
    document.getElementById("cert_b").appendChild(y);
}
