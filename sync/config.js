var baseHost = window.location.hostname;

var baseHost = '10.116.1.77';
var baseEndpoint = 'http://' + baseHost;


var statusupdate = false;
var selected_network_ssid = "";
var ipaddress = "";

function BaseViewModel(defaults, remoteUrl, mappings) {
    if (mappings === undefined) {
        mappings = {};
    }
    var self = this;
    self.remoteUrl = remoteUrl;

    // Observable properties
    ko.mapping.fromJS(defaults, mappings, self);
    self.fetching = ko.observable(false);
}

BaseViewModel.prototype.update = function (after) {
    if (after === undefined) {
        after = function () {};
    }
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
        "btn1": "",
        "btn2": "",
        "btn3": "",
        "btn4": ""
    }, baseEndpoint + '/status');
}
StatusViewModel.prototype = Object.create(BaseViewModel.prototype);
StatusViewModel.prototype.constructor = StatusViewModel;



function OrangeViewModel() {
    var self = this;


    self.status = new StatusViewModel();

    self.initialised = ko.observable(false);
    self.updating = ko.observable(false);

    var updateTimer = null;
    var updateTime = 1 * 1000;

    // Upgrade URL
    self.upgradeUrl = ko.observable('about:blank');

    // -----------------------------------------------------------------------
    // Initialise the app
    // -----------------------------------------------------------------------
    self.start = function () {
        self.updating(true);
        self.status.update(function () {
            self.initialised(true);
            updateTimer = setTimeout(self.update, updateTime);
            self.upgradeUrl(baseEndpoint + '/update');
            self.updating(false);
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
            alert("Failed!");
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
            alert("Failed!");
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
            alert("Failed!");
        }).always(function () {
            self.BTN3Fetching(false);
        });
    };
    // -----------------------------------------------------------------------
    // Event: BTN4
    // -----------------------------------------------------------------------
    self.BTN4Fetching = ko.observable(false);
    self.BTN4Success = ko.observable(false);
    self.BTN4 = function () {
        self.BTN4Fetching(true);
        self.BTN4Success(false);
        $.post(baseEndpoint + "/btn4", function (data) {
            self.BTN4Success(true);
        }).fail(function () {
            alert("Failed!");
        }).always(function () {
            self.BTN4Fetching(false);
        });
    };
}
$(function () {
    // Activates knockout.js
    var orange = new OrangeViewModel();
    ko.applyBindings(orange);
    orange.start();
});
