var $DOCUMENT = window.document;
function MZIQ_StockInfo() {
    var e = this;
    function a(a) {
        return "pt" === e.LANGUAGE ? a.replace(".", ",") : a
    }
    function t(t) {
        if (!0 === t.toString().includes(".")) {
            var s = t.toString().replace(".", "");
            !0 === e.IS_INDEX && (t = parseInt(t.toString().replace(".", ""))),
            Number(s) > 1e3 && (t = s,
            t = Number(t))
        }
        return a(t >= 11e9 ? (t / 1e10).toFixed(1) + "T" : t >= 1e10 ? (t / 1e10).toFixed(0) + "T" : t >= 11e8 ? (t / 1e9).toFixed(1) + "B" : t >= 1e9 ? (t / 1e9).toFixed(0) + "B" : t >= 11e5 ? (t / 1e6).toFixed(1) + "M" : t >= 1e6 ? (t / 1e6).toFixed(0) + "M" : t >= 1e5 ? (t / 1e3).toFixed(0) + "K" : t >= 1e4 ? (t / 1e3).toFixed(0) + "K" : t >= 1100 ? (t / 1e3).toFixed(1) + "K" : t >= 1e3 ? (t / 1e3).toFixed(0) + "K" : parseInt(t).toString())
    }
    function s(e) {
        if (0 !== e.length) {
            console.error("Stockinfo errors: ");
            for (var a = 0; a < e.length; a++)
                console.error(e[a])
        }
    }
    function n(a, t, s) {
        if (!a)
            return "-";
        var n = ""
          , r = void 0
          , i = {
            minimumFractionDigits: e.DECIMAL_PLACES,
            maximumFractionDigits: e.DECIMAL_PLACES
        };
        switch (!0 === s && (i = {}),
        t && e.CURRENCY_SYMBOL && !0 !== s && (n = e.CURRENCY_SYMBOL + " "),
        e.LANGUAGE) {
        case "pt":
        case "pt-br":
        case "es":
        case "es-es":
            r = n + a.toLocaleString("pt-BR", i);
            break;
        case "zh-hant":
        case "zh-hans":
        case "fr":
        case "de":
        default:
            r = n + a.toLocaleString("en-US", i)
        }
        return r
    }
    function r(a, t, s) {
        if (!a)
            return "-";
        var n = {
            minimumFractionDigits: e.DECIMAL_PLACES,
            maximumFractionDigits: e.DECIMAL_PLACES
        };
        switch (!0 !== e.IS_INDEX && !0 !== s && !1 !== t || (n = {}),
        e.LANGUAGE) {
        case "pt":
        case "pt-br":
        case "es":
        case "es-es":
            return a.toLocaleString("pt-BR", n);
        case "zh-hant":
        case "zh-hans":
        case "fr":
        case "de":
        default:
            return a.toLocaleString("en-US", n)
        }
    }
    function i(a) {
        var t = void 0;
        return a.map(function(e) {
            var a = moment(e.info.date + " " + e.info.time, "YYYY-MM-DD HH:mm:ss");
            (!t || a.diff(t, "minutes") > 0) && (t = a)
        }),
        "pt" === e.LANGUAGE || "es" === e.LANGUAGE || "pt-br" === e.LANGUAGE || "es-es" === e.LANGUAGE ? t.format("DD/MM/YY HH:mm") : t.format("MM/DD/YY hh:mm A")
    }
    function l(a, t) {
        !function(a) {
            e.STOCK_ID = a.stockinfoId,
            e.LANGUAGE = a.language ? a.language : "pt",
            e.MOMENT_DATE_FORMAT = "pt" === e.LANGUAGE || "es" === e.LANGUAGE || "pt-br" === e.LANGUAGE || "es-es" === e.LANGUAGE ? "DD/MM/YYYY" : "MM/DD/YYYY",
            e.CURRENCY_SYMBOL = a.currencySymbol ? a.currencySymbol : "R$",
            e.DECIMAL_PLACES = a.decimalPlaces ? a.decimalPlaces : 2
        }(a),
        function(a) {
            var t = e.API_URL + "/" + e.STOCK_ID + "/live";
            $.ajax({
                url: t,
                type: "GET",
                dataType: "json",
                success: function(e) {
                    if (!e.data)
                        return a(null);
                    var t = e.data.tickers.length > 0 || e.data.indexes.length > 0;
                    return t ? (s(e.data.errors),
                    a(e.data)) : (s(e.data.errors),
                    a(null))
                },
                error: function(e) {
                    return console.error("Erro ao recuperar dados da API: "),
                    console.error(e),
                    a(null)
                }
            })
        }(t)
    }
    function o(e, a) {
        var t = "<thead>";
        return Object.keys(e).forEach(function(s) {
            if (a.template.columns && !a.template.columns.includes(s))
                return !1;
            t += '<th class="' + e[s].className + '">' + e[s].label + "</th>"
        }),
        t += "</thead>"
    }
    function c(a) {
        var t = function(e) {
            return !(!a.customLabels || !a.customLabels[e]) && a.customLabels[e]
        };
        return {
            pt: function() {
                var e = {
                    date: {
                        label: !1 !== t("date") ? t("date") : "Data",
                        className: "date"
                    },
                    var: {
                        label: !1 !== t("var") ? t("var") : "Variação (%)",
                        className: "var variation"
                    },
                    high: {
                        label: !1 !== t("high") ? t("high") : "Máxima",
                        className: "max high"
                    },
                    low: {
                        label: !1 !== t("low") ? t("low") : "Mínima",
                        className: "min low"
                    },
                    open: {
                        label: !1 !== t("open") ? t("open") : "Aberto",
                        className: "open"
                    },
                    closed: {
                        label: !1 !== t("closed") ? t("closed") : "Fechado",
                        className: "closed"
                    },
                    middle: {
                        label: !1 !== t("middle") ? t("middle") : "Média",
                        className: "middle"
                    },
                    vol: {
                        label: !1 !== t("vol") ? t("vol") : "Volume",
                        className: "vol"
                    },
                    share: {
                        label: !1 !== t("share") ? t("share") : "Quantidade",
                        className: "share"
                    },
                    trade: {
                        label: !1 !== t("trade") ? t("trade") : "Negócios",
                        className: "trade"
                    }
                };
                if ("live" === a.template.type) {
                    var s = {
                        marketCap: {
                            label: !1 !== t("marketCap") ? t("marketCap") : "Market Cap",
                            className: "marketCap"
                        },
                        price: {
                            label: !1 !== t("price") ? t("price") : "Preço",
                            className: "price"
                        },
                        dtMin52: {
                            label: !1 !== t("dtMin52") ? t("dtMin52") : "Data MIN52",
                            className: "dtMin52"
                        },
                        dtMax52: {
                            label: !1 !== t("dtMax52") ? t("dtMax52") : "Data MAX52",
                            className: "dtMax52"
                        },
                        time: {
                            label: !1 !== t("time") ? t("time") : "Hora",
                            className: "time"
                        },
                        max52: {
                            label: !1 !== t("max52") ? t("max52") : "Max52",
                            className: "max52"
                        },
                        min52: {
                            label: !1 !== t("min52") ? t("min52") : "Min52",
                            className: "min52"
                        }
                    };
                    Object.keys(s).forEach(function(a) {
                        e[a] = s[a]
                    })
                }
                return o(e, a)
            },
            "pt-br": function() {
                var e = {
                    date: {
                        label: !1 !== t("date") ? t("date") : "Data",
                        className: "date"
                    },
                    var: {
                        label: !1 !== t("var") ? t("var") : "Variação (%)",
                        className: "var variation"
                    },
                    high: {
                        label: !1 !== t("high") ? t("high") : "Máxima",
                        className: "max high"
                    },
                    low: {
                        label: !1 !== t("low") ? t("low") : "Mínima",
                        className: "min low"
                    },
                    open: {
                        label: !1 !== t("open") ? t("open") : "Aberto",
                        className: "open"
                    },
                    closed: {
                        label: !1 !== t("closed") ? t("closed") : "Fechado",
                        className: "closed"
                    },
                    middle: {
                        label: !1 !== t("middle") ? t("middle") : "Média",
                        className: "middle"
                    },
                    vol: {
                        label: !1 !== t("vol") ? t("vol") : "Volume",
                        className: "vol"
                    },
                    share: {
                        label: !1 !== t("share") ? t("share") : "Quantidade",
                        className: "share"
                    },
                    trade: {
                        label: !1 !== t("trade") ? t("trade") : "Negócios",
                        className: "trade"
                    }
                };
                if ("live" === a.template.type) {
                    var s = {
                        marketCap: {
                            label: !1 !== t("marketCap") ? t("marketCap") : "Market Cap",
                            className: "marketCap"
                        },
                        price: {
                            label: !1 !== t("price") ? t("price") : "Preço",
                            className: "price"
                        },
                        dtMin52: {
                            label: !1 !== t("dtMin52") ? t("dtMin52") : "Data MIN52",
                            className: "dtMin52"
                        },
                        dtMax52: {
                            label: !1 !== t("dtMax52") ? t("dtMax52") : "Data MAX52",
                            className: "dtMax52"
                        },
                        time: {
                            label: !1 !== t("time") ? t("time") : "Hora",
                            className: "time"
                        },
                        max52: {
                            label: !1 !== t("max52") ? t("max52") : "Max52",
                            className: "max52"
                        },
                        min52: {
                            label: !1 !== t("min52") ? t("min52") : "Min52",
                            className: "min52"
                        }
                    };
                    Object.keys(s).forEach(function(a) {
                        e[a] = s[a]
                    })
                }
                return o(e, a)
            },
            es: function() {
                var e = {
                    date: {
                        label: !1 !== t("date") ? t("date") : "Fecha",
                        className: "date"
                    },
                    var: {
                        label: !1 !== t("var") ? t("var") : "Variación (%)",
                        className: "var variation"
                    },
                    high: {
                        label: !1 !== t("high") ? t("high") : "Máxima",
                        className: "max high"
                    },
                    low: {
                        label: !1 !== t("low") ? t("low") : "Minimo",
                        className: "min low"
                    },
                    open: {
                        label: !1 !== t("open") ? t("open") : "Abierto",
                        className: "open"
                    },
                    closed: {
                        label: !1 !== t("closed") ? t("closed") : "Cerrado",
                        className: "closed"
                    },
                    middle: {
                        label: !1 !== t("middle") ? t("middle") : "Promedio",
                        className: "middle"
                    },
                    vol: {
                        label: !1 !== t("vol") ? t("vol") : "Volumen",
                        className: "vol"
                    },
                    share: {
                        label: !1 !== t("share") ? t("share") : "Cantidad",
                        className: "share"
                    },
                    trade: {
                        label: !1 !== t("trade") ? t("trade") : "Negocios",
                        className: "trade"
                    }
                };
                if ("live" === a.template.type) {
                    var s = {
                        marketCap: {
                            label: !1 !== t("marketCap") ? t("marketCap") : "Market Cap",
                            className: "marketCap"
                        },
                        price: {
                            label: !1 !== t("price") ? t("price") : "Precio",
                            className: "price"
                        },
                        dtMin52: {
                            label: !1 !== t("dtMin52") ? t("dtMin52") : "Fecha MIN52",
                            className: "dtMin52"
                        },
                        dtMax52: {
                            label: !1 !== t("dtMax52") ? t("dtMax52") : "Fecha MAX52",
                            className: "dtMax52"
                        },
                        time: {
                            label: !1 !== t("time") ? t("time") : "Tiempo",
                            className: "time"
                        },
                        max52: {
                            label: !1 !== t("max52") ? t("max52") : "Max52",
                            className: "max52"
                        },
                        min52: {
                            label: !1 !== t("min52") ? t("min52") : "Min52",
                            className: "min52"
                        }
                    };
                    Object.keys(s).forEach(function(a) {
                        e[a] = s[a]
                    })
                }
                return o(e, a)
            },
            "es-es": function() {
                var e = {
                    date: {
                        label: !1 !== t("date") ? t("date") : "Fecha",
                        className: "date"
                    },
                    var: {
                        label: !1 !== t("var") ? t("var") : "Variación (%)",
                        className: "var variation"
                    },
                    high: {
                        label: !1 !== t("high") ? t("high") : "Máxima",
                        className: "max high"
                    },
                    low: {
                        label: !1 !== t("low") ? t("low") : "Minimo",
                        className: "min low"
                    },
                    open: {
                        label: !1 !== t("open") ? t("open") : "Abierto",
                        className: "open"
                    },
                    closed: {
                        label: !1 !== t("closed") ? t("closed") : "Cerrado",
                        className: "closed"
                    },
                    middle: {
                        label: !1 !== t("middle") ? t("middle") : "Promedio",
                        className: "middle"
                    },
                    vol: {
                        label: !1 !== t("vol") ? t("vol") : "Volumen",
                        className: "vol"
                    },
                    share: {
                        label: !1 !== t("share") ? t("share") : "Cantidad",
                        className: "share"
                    },
                    trade: {
                        label: !1 !== t("trade") ? t("trade") : "Negocios",
                        className: "trade"
                    }
                };
                if ("live" === a.template.type) {
                    var s = {
                        marketCap: {
                            label: !1 !== t("marketCap") ? t("marketCap") : "Market Cap",
                            className: "marketCap"
                        },
                        price: {
                            label: !1 !== t("price") ? t("price") : "Precio",
                            className: "price"
                        },
                        dtMin52: {
                            label: !1 !== t("dtMin52") ? t("dtMin52") : "Fecha MIN52",
                            className: "dtMin52"
                        },
                        dtMax52: {
                            label: !1 !== t("dtMax52") ? t("dtMax52") : "Fecha MAX52",
                            className: "dtMax52"
                        },
                        time: {
                            label: !1 !== t("time") ? t("time") : "Tiempo",
                            className: "time"
                        },
                        max52: {
                            label: !1 !== t("max52") ? t("max52") : "Max52",
                            className: "max52"
                        },
                        min52: {
                            label: !1 !== t("min52") ? t("min52") : "Min52",
                            className: "min52"
                        }
                    };
                    Object.keys(s).forEach(function(a) {
                        e[a] = s[a]
                    })
                }
                return o(e, a)
            },
            en: function() {
                var e = {
                    date: {
                        label: !1 !== t("date") ? t("date") : "Date",
                        className: "date"
                    },
                    var: {
                        label: !1 !== t("var") ? t("var") : "Variation (%)",
                        className: "var variation"
                    },
                    high: {
                        label: !1 !== t("high") ? t("high") : "High",
                        className: "max high"
                    },
                    low: {
                        label: !1 !== t("low") ? t("low") : "Low",
                        className: "min low"
                    },
                    open: {
                        label: !1 !== t("open") ? t("open") : "Open",
                        className: "open"
                    },
                    closed: {
                        label: !1 !== t("closed") ? t("closed") : "Closed",
                        className: "closed"
                    },
                    middle: {
                        label: !1 !== t("middle") ? t("middle") : "Middle",
                        className: "middle"
                    },
                    vol: {
                        label: !1 !== t("vol") ? t("vol") : "Volume",
                        className: "vol"
                    },
                    share: {
                        label: !1 !== t("share") ? t("share") : "Shares",
                        className: "share"
                    },
                    trade: {
                        label: !1 !== t("trade") ? t("trade") : "Trades",
                        className: "trade"
                    }
                };
                if ("live" === a.template.type) {
                    var s = {
                        marketCap: {
                            label: !1 !== t("marketCap") ? t("marketCap") : "Market Cap",
                            className: "marketCap"
                        },
                        price: {
                            label: !1 !== t("price") ? t("price") : "Price",
                            className: "price"
                        },
                        dtMin52: {
                            label: !1 !== t("dtMin52") ? t("dtMin52") : "Date MIN52",
                            className: "dtMin52"
                        },
                        dtMax52: {
                            label: !1 !== t("dtMax52") ? t("dtMax52") : "Date MAX52",
                            className: "dtMax52"
                        },
                        time: {
                            label: !1 !== t("time") ? t("time") : "Time",
                            className: "time"
                        },
                        max52: {
                            label: !1 !== t("max52") ? t("max52") : "Max52",
                            className: "max52"
                        },
                        min52: {
                            label: !1 !== t("min52") ? t("min52") : "Min52",
                            className: "min52"
                        }
                    };
                    Object.keys(s).forEach(function(a) {
                        e[a] = s[a]
                    })
                }
                return o(e, a)
            },
            "zh-hant": function() {
                var e = {
                    date: {
                        label: !1 !== t("date") ? t("date") : "日期",
                        className: "date"
                    },
                    var: {
                        label: !1 !== t("var") ? t("var") : "變化（％）",
                        className: "var variation"
                    },
                    high: {
                        label: !1 !== t("high") ? t("high") : "最大限度",
                        className: "max high"
                    },
                    low: {
                        label: !1 !== t("low") ? t("low") : "最低限度",
                        className: "min low"
                    },
                    open: {
                        label: !1 !== t("open") ? t("open") : "打開",
                        className: "open"
                    },
                    closed: {
                        label: !1 !== t("closed") ? t("closed") : "關閉",
                        className: "closed"
                    },
                    middle: {
                        label: !1 !== t("middle") ? t("middle") : "平均",
                        className: "middle"
                    },
                    vol: {
                        label: !1 !== t("vol") ? t("vol") : "體積",
                        className: "vol"
                    },
                    share: {
                        label: !1 !== t("share") ? t("share") : "數量",
                        className: "share"
                    },
                    trade: {
                        label: !1 !== t("trade") ? t("trade") : "商業",
                        className: "trade"
                    }
                };
                if ("live" === a.template.type) {
                    var s = {
                        marketCap: {
                            label: !1 !== t("marketCap") ? t("marketCap") : "市值",
                            className: "marketCap"
                        },
                        price: {
                            label: !1 !== t("price") ? t("price") : "價格",
                            className: "price"
                        },
                        dtMin52: {
                            label: !1 !== t("dtMin52") ? t("dtMin52") : "最少約會52",
                            className: "dtMin52"
                        },
                        dtMax52: {
                            label: !1 !== t("dtMax52") ? t("dtMax52") : "最長日期52",
                            className: "dtMax52"
                        },
                        time: {
                            label: !1 !== t("time") ? t("time") : "小時",
                            className: "time"
                        },
                        max52: {
                            label: !1 !== t("max52") ? t("max52") : "最多52",
                            className: "max52"
                        },
                        min52: {
                            label: !1 !== t("min52") ? t("min52") : "最低52",
                            className: "min52"
                        }
                    };
                    Object.keys(s).forEach(function(a) {
                        e[a] = s[a]
                    })
                }
                return o(e, a)
            },
            "zh-hans": function() {
                var e = {
                    date: {
                        label: !1 !== t("date") ? t("date") : "日期",
                        className: "date"
                    },
                    var: {
                        label: !1 !== t("var") ? t("var") : "变化（％）",
                        className: "var variation"
                    },
                    high: {
                        label: !1 !== t("high") ? t("high") : "最大限度",
                        className: "max high"
                    },
                    low: {
                        label: !1 !== t("low") ? t("low") : "最低限度",
                        className: "min low"
                    },
                    open: {
                        label: !1 !== t("open") ? t("open") : "打开",
                        className: "open"
                    },
                    closed: {
                        label: !1 !== t("closed") ? t("closed") : "关闭",
                        className: "closed"
                    },
                    middle: {
                        label: !1 !== t("middle") ? t("middle") : "平均",
                        className: "middle"
                    },
                    vol: {
                        label: !1 !== t("vol") ? t("vol") : "体积",
                        className: "vol"
                    },
                    share: {
                        label: !1 !== t("share") ? t("share") : "数量",
                        className: "share"
                    },
                    trade: {
                        label: !1 !== t("trade") ? t("trade") : "商业",
                        className: "trade"
                    }
                };
                if ("live" === a.template.type) {
                    var s = {
                        marketCap: {
                            label: !1 !== t("marketCap") ? t("marketCap") : "市值",
                            className: "marketCap"
                        },
                        price: {
                            label: !1 !== t("price") ? t("price") : "价格",
                            className: "price"
                        },
                        dtMin52: {
                            label: !1 !== t("dtMin52") ? t("dtMin52") : "最少约会52",
                            className: "dtMin52"
                        },
                        dtMax52: {
                            label: !1 !== t("dtMax52") ? t("dtMax52") : "最长日期52",
                            className: "dtMax52"
                        },
                        time: {
                            label: !1 !== t("time") ? t("time") : "小时",
                            className: "time"
                        },
                        max52: {
                            label: !1 !== t("max52") ? t("max52") : "最多52",
                            className: "max52"
                        },
                        min52: {
                            label: !1 !== t("min52") ? t("min52") : "最低52",
                            className: "min52"
                        }
                    };
                    Object.keys(s).forEach(function(a) {
                        e[a] = s[a]
                    })
                }
                return o(e, a)
            },
            fr: function() {
                var e = {
                    date: {
                        label: !1 !== t("date") ? t("date") : "Date",
                        className: "date"
                    },
                    var: {
                        label: !1 !== t("var") ? t("var") : "Variation (%)",
                        className: "var variation"
                    },
                    high: {
                        label: !1 !== t("high") ? t("high") : "Haut",
                        className: "max high"
                    },
                    low: {
                        label: !1 !== t("low") ? t("low") : "Faible",
                        className: "min low"
                    },
                    open: {
                        label: !1 !== t("open") ? t("open") : "Ouvrir",
                        className: "open"
                    },
                    closed: {
                        label: !1 !== t("closed") ? t("closed") : "Fermé",
                        className: "closed"
                    },
                    middle: {
                        label: !1 !== t("middle") ? t("middle") : "Milieu",
                        className: "middle"
                    },
                    vol: {
                        label: !1 !== t("vol") ? t("vol") : "Le volume",
                        className: "vol"
                    },
                    share: {
                        label: !1 !== t("share") ? t("share") : "Actions",
                        className: "share"
                    },
                    trade: {
                        label: !1 !== t("trade") ? t("trade") : "Métiers",
                        className: "trade"
                    }
                };
                if ("live" === a.template.type) {
                    var s = {
                        marketCap: {
                            label: !1 !== t("marketCap") ? t("marketCap") : "Capitalisation Boursière",
                            className: "marketCap"
                        },
                        price: {
                            label: !1 !== t("price") ? t("price") : "Prix",
                            className: "price"
                        },
                        dtMin52: {
                            label: !1 !== t("dtMin52") ? t("dtMin52") : "Date MIN52",
                            className: "dtMin52"
                        },
                        dtMax52: {
                            label: !1 !== t("dtMax52") ? t("dtMax52") : "Date MAX52",
                            className: "dtMax52"
                        },
                        time: {
                            label: !1 !== t("time") ? t("time") : "Temps",
                            className: "time"
                        },
                        max52: {
                            label: !1 !== t("max52") ? t("max52") : "Max52",
                            className: "max52"
                        },
                        min52: {
                            label: !1 !== t("min52") ? t("min52") : "Min52",
                            className: "min52"
                        }
                    };
                    Object.keys(s).forEach(function(a) {
                        e[a] = s[a]
                    })
                }
                return o(e, a)
            },
            de: function() {
                var e = {
                    date: {
                        label: !1 !== t("date") ? t("date") : "Datum",
                        className: "date"
                    },
                    var: {
                        label: !1 !== t("var") ? t("var") : "Variation (%)",
                        className: "var variation"
                    },
                    high: {
                        label: !1 !== t("high") ? t("high") : "Hoch",
                        className: "max high"
                    },
                    low: {
                        label: !1 !== t("low") ? t("low") : "Niedrig",
                        className: "min low"
                    },
                    open: {
                        label: !1 !== t("open") ? t("open") : "Öffnen",
                        className: "open"
                    },
                    closed: {
                        label: !1 !== t("closed") ? t("closed") : "Geschlossen",
                        className: "closed"
                    },
                    middle: {
                        label: !1 !== t("middle") ? t("middle") : "Mitte",
                        className: "middle"
                    },
                    vol: {
                        label: !1 !== t("vol") ? t("vol") : "Volumen",
                        className: "vol"
                    },
                    share: {
                        label: !1 !== t("share") ? t("share") : "Anteile",
                        className: "share"
                    },
                    trade: {
                        label: !1 !== t("trade") ? t("trade") : "Trades",
                        className: "trade"
                    }
                };
                if ("live" === a.template.type) {
                    var s = {
                        marketCap: {
                            label: !1 !== t("marketCap") ? t("marketCap") : "Marktkapitalisierung",
                            className: "marketCap"
                        },
                        price: {
                            label: !1 !== t("price") ? t("price") : "Preis",
                            className: "price"
                        },
                        dtMin52: {
                            label: !1 !== t("dtMin52") ? t("dtMin52") : "Datum MIN52",
                            className: "dtMin52"
                        },
                        dtMax52: {
                            label: !1 !== t("dtMax52") ? t("dtMax52") : "Datum MAX52",
                            className: "dtMax52"
                        },
                        time: {
                            label: !1 !== t("time") ? t("time") : "Zeit",
                            className: "time"
                        },
                        max52: {
                            label: !1 !== t("max52") ? t("max52") : "Max52",
                            className: "max52"
                        },
                        min52: {
                            label: !1 !== t("min52") ? t("min52") : "Min52",
                            className: "min52"
                        }
                    };
                    Object.keys(s).forEach(function(a) {
                        e[a] = s[a]
                    })
                }
                return o(e, a)
            }
        }[e.LANGUAGE]()
    }
    function m(e, a) {
        var t = e.template.columns;
        if (a && !e.template.columns) {
            var s = [];
            s.push("ticker"),
            Object.keys(a).forEach(function(e) {
                s.push(e)
            }),
            t = s
        }
        if (!t || void 0 === t)
            return !1;
        t.forEach(function(e, a) {
            var t = $("thead tr th." + e)
              , s = $("tbody tr");
            t.parent().append(t),
            s.each(function() {
                var a = $(this).find("." + e);
                a.parent().append(a)
            })
        })
    }
    function d(a) {
        var t = e.API_URL + "/" + e.STOCK_ID + "/history?from=" + e.START_DATE.format("YYYY-MM-DD") + "&to=" + e.END_DATE.format("YYYY-MM-DD") + switchTickerIndex + "&adjusted=" + e.ADJUSTED;
        console.log('url: ')
        $.ajax({
            url: t,
            type: "GET",
            dataType: "json",
            success: function(t) {
                console.log('t: ',t.data)
                if (0 === (e.IS_INDEX ? t.data.indexes.length : t.data.tickers.length))
                    return console.warn("Nenhum dado encontrado!"),
                    void console.error("Errors", t.data.errors);
                var n = e.IS_INDEX ? t.data.indexes[0].history : t.data.tickers[0].history;
                p(!1),
                function(a, t, s, n) {
                    $(".custom-arrow-td").remove(),
                    $.each(a, function(t) {
                        var n = a[t]
                          , r = "up"
                          , i = document.createElement("tr");
                        if (this.var < 0 && (r = "down"),
                        r = 0 === this.var ? "neutral" : r,
                        i.className = "item",
                        $(".ticker-infos .table__history").append(i),
                        Object.keys(n).forEach(function(e) {
                            if (s.template.columns && !s.template.columns.includes(e))
                                return !1;
                            var n = a[t][e];
                            $(i).append('<td class="' + u(e, r) + '">' + v(s, e) + h(e, n, r) + f(s, e) + "</td>")
                        }),
                        s.template.customArrow)
                            if (void 0 !== e.ARROW_IMAGES) {
                                var l;
                                a[t].var < 0 ? l = e.ARROW_IMAGES.down : a[t].var > 0 ? l = e.ARROW_IMAGES.up : 0 === a[t].var && (l = e.ARROW_IMAGES.neutral),
                                $(i).append('<td class="arrow custom-arrow-td"><img class="custom-arrow-image" src="' + l + '"></img></td>')
                            } else {
                                var o = a[t].var < 0 ? "down" : "up";
                                $(i).append('<td class="arrow custom-arrow-td"><span class="custom-arrow-default ' + o + '"></span></td>')
                            }
                    });
                    var r = function(e) {
                        return !(!s.customLabels || !s.customLabels[e]) && s.customLabels[e]
                    }
                      , i = !1 !== r("arrow") ? r("arrow") : "Arrow";
                    s.template.customArrow && ($("th.arrow.custom-arrow").remove(),
                    $(".ticker-infos .table__history thead tr").append('<th class="arrow custom-arrow">' + i + "</th>"));
                    m(s);
                    $("#source").html("<a href=" + n + ' target="_blank">' + {
                        pt: "Fonte: ",
                        "pt-br": "Fonte: ",
                        es: "Fuente: ",
                        "es-es": "Fuente: ",
                        en: "Source: ",
                        "zh-hant": "來源: ",
                        "zh-hans": "来源: ",
                        fr: "La source: ",
                        de: "Quelle: "
                    }[s.language] + t + "</a>"),
                    b(s)
                }(n, t.data.source, a, t.data.link),
                s(t.data.errors)
            },
            error: function(e) {
                console.warn("Não foi possível recuperar os dados históricos. Tente novamente ou contate o suporte!"),
                console.error("Erro ao recuperar dados da API: "),
                console.error(e)
            }
        })
    }
    function p(e) {
        ([].slice.call($DOCUMENT.querySelectorAll(".table__history .item")).forEach(function(e) {
            e.parentNode.removeChild(e)
        }),
        e) ? $(".ticker-infos .table__history").append('<tr class="loading"><td colspan="10">Carregando...</td></tr>') : [].slice.call($DOCUMENT.querySelectorAll(".table__history .loading")).forEach(function(e) {
            e.parentNode.removeChild(e)
        })
    }
    function u(e, a) {
        return "var" === e ? "var variation " + a : e
    }
    function h(a, s, i, l) {
        return (!0 === e.IS_INDEX && "high" === a || !0 === e.IS_INDEX && "low" === a || !0 === e.IS_INDEX && "middle" === a || !0 === e.IS_INDEX && "open" === a || !0 === e.IS_INDEX && "closed" === a) && (s = parseInt(s.toString().replace(".", ""))),
        {
            date: function() {
                return moment(s).format(e.MOMENT_DATE_FORMAT)
            },
            var: function() {
                if (0 === s)
                    return "-";
                var a, t = !0 === e.SHOW_VARIATION_ARROW ? '%  <span class="icon ' + i + '"></span>' : "%";
                void 0 !== e.ARROW_IMAGES && !0 === e.SHOW_VARIATION_ARROW && (s < 0 ? a = e.ARROW_IMAGES.down : s > 0 ? a = e.ARROW_IMAGES.up : 0 === s && (a = e.ARROW_IMAGES.neutral),
                t = '% <img class="arrow-custom-image" src="' + a + '"></img>');
                return n(s, !1) + t
            },
            high: function() {
                return !0 === e.HAS_SHORT_MODE && s > 1e3 ? !1 === l ? e.CURRENCY_SYMBOL : " " + t(s) : e.IS_INDEX ? r(parseInt(s.toString().replace(".", "")), !0, l) : n(s, !0, l)
            },
            low: function() {
                return !0 === e.HAS_SHORT_MODE && s > 1e3 ? !1 === l ? e.CURRENCY_SYMBOL : " " + t(s) : e.IS_INDEX ? r(parseInt(s.toString().replace(".", "")), !0, l) : n(s, !0, l)
            },
            open: function() {
                return !0 === e.HAS_SHORT_MODE && s > 1e3 ? !1 === l ? e.CURRENCY_SYMBOL : " " + t(s) : e.IS_INDEX ? r(parseInt(s.toString().replace(".", "")), !0, l) : n(s, !0, l)
            },
            closed: function() {
                return !0 === e.HAS_SHORT_MODE && s > 1e3 ? !1 === l ? e.CURRENCY_SYMBOL : " " + t(s) : e.IS_INDEX ? r(parseInt(s.toString().replace(".", "")), !0, l) : n(s, !0, l)
            },
            middle: function() {
                return !0 === e.HAS_SHORT_MODE && s > 1e3 ? !1 === l ? e.CURRENCY_SYMBOL : " " + t(s) : e.IS_INDEX ? r(parseInt(s.toString().replace(".", "")), !0, l) : n(s, !0, l)
            },
            vol: function() {
                return !0 === e.HAS_SHORT_MODE && s > 1e3 ? t(s) : r(s, !1, l)
            },
            share: function() {
                return !0 === e.HAS_SHORT_MODE && s > 1e3 ? t(s) : r(s, !1, l)
            },
            trade: function() {
                return !0 === e.HAS_SHORT_MODE && s > 1e3 ? t(s) : r(s, !1, l)
            },
            marketCap: function() {
                return !0 === e.HAS_SHORT_MODE && s > 1e3 ? t(s) : r(s, !1, l)
            },
            price: function() {
                return !0 === e.HAS_SHORT_MODE && s > 1e3 ? !1 === l ? e.CURRENCY_SYMBOL : " " + t(s) : n(s, !0, l)
            },
            dtMin52: function() {
                return moment(s).format(e.MOMENT_DATE_FORMAT)
            },
            dtMax52: function() {
                return moment(s).format(e.MOMENT_DATE_FORMAT)
            },
            time: function() {
                return s
            },
            max52: function() {
                return !0 === e.HAS_SHORT_MODE && s > 1e3 ? !1 === l ? e.CURRENCY_SYMBOL : " " + t(s) : e.IS_INDEX ? r(parseInt(s.toString().replace(".", "")), !0, l) : n(s, !0, l)
            },
            min52: function() {
                return !0 === e.HAS_SHORT_MODE && s > 1e3 ? !1 === l ? e.CURRENCY_SYMBOL : " " + t(s) : e.IS_INDEX ? r(parseInt(s.toString().replace(".", "")), !0, l) : n(s, !0, l)
            }
        }[a]()
    }
    function b(a) {
        if (!a.template.suffix)
            return "";
        $(e.rootElement).find(".custom-item.legend").remove(),
        a.template.suffix.map(function(a) {
            !0 === a.isLegend && $(e.rootElement).append('<p class="custom-item legend">' + a.symbol + " - " + a.legend + "</p>")
        })
    }
    function v(e, a) {
        if (!e.template.preffix)
            return "";
        var t = e.template.preffix.filter(function(e) {
            return e.field === a
        }).pop();
        return void 0 !== t ? '<span class="symbol preffix">' + t.symbol + "</span>" : ""
    }
    function f(e, a) {
        if (!e.template.suffix)
            return "";
        var t = e.template.suffix.filter(function(e) {
            return e.field === a
        }).pop();
        return void 0 !== t ? '<span class="symbol suffix">' + t.symbol + "</span>" : ""
    }
    function A(a) {
        !function(a) {
            e.STOCK_ID = a.stockinfoId,
            e.LANGUAGE = a.language ? a.language : "pt",
            chartType = a.chartType ? a.chartType : "line",
            chartColors = a.chartColors ? a.chartColors : ["#42677c", "#B22222", "#008000", "#FF8C00", "#FF00FF", "#00BFFF"],
            e.MOMENT_DATE_FORMAT = "pt" === a.language || "es" === a.language || "pt-br" === a.language || "es-es" === a.language ? "DD/MM/YYYY HH:mm" : "MM/DD/YYYY hh:mm A",
            chartHeight = a.height ? a.height : 400,
            e.CURRENCY_SYMBOL = a.currencySymbol ? a.currencySymbol : "R$",
            isSimpleChart = !!a.template.isSimpleChart && a.template.isSimpleChart,
            e.TICKER = a.tickers,
            e.ADJUSTED = a.adjusted ? a.adjusted : e.ADJUSTED,
            "spline" === chartType && (chartType = "line");
            if (a.chartPeriod) {
                var t = {
                    "1m": function() {
                        e.START_DATE = moment().subtract(1, "months"),
                        e.CHART_PERIOD = "1m"
                    },
                    "6m": function() {
                        e.START_DATE = moment().subtract(6, "months"),
                        e.CHART_PERIOD = "6m"
                    },
                    "1y": function() {
                        e.START_DATE = moment().subtract(1, "years"),
                        e.CHART_PERIOD = "1y"
                    },
                    "3y": function() {
                        e.START_DATE = moment().subtract(3, "years"),
                        e.CHART_PERIOD = "3y"
                    },
                    "5y": function() {
                        e.START_DATE = moment().subtract(5, "years"),
                        e.CHART_PERIOD = "5y"
                    }
                };
                t[a.chartPeriod]()
            }
        }(a),
        function(a) {
            var t = void 0
              , s = void 0
              , n = void 0
              , r = {
                pt: {
                    date: "%b %e, %Y",
                    edit: "%Y-%m-%d"
                },
                "pt-br": {
                    date: "%b %e, %Y",
                    edit: "%Y-%m-%d"
                },
                es: {
                    date: "%b %e, %Y",
                    edit: "%Y-%m-%d"
                },
                "es-es": {
                    date: "%b %e, %Y",
                    edit: "%Y-%m-%d"
                },
                en: {
                    date: "%b %e, %Y",
                    edit: "%Y-%m-%d"
                },
                "zh-hant": {
                    date: "%b %e, %Y",
                    edit: "%Y-%m-%d"
                },
                "zh-hans": {
                    date: "%b %e, %Y",
                    edit: "%Y-%m-%d"
                },
                fr: {
                    date: "%b %e, %Y",
                    edit: "%Y-%m-%d"
                },
                de: {
                    date: "%b %e, %Y",
                    edit: "%Y-%m-%d"
                }
            };
            switch (e.LANGUAGE) {
            case "pt":
            case "pt-br":
                t = {
                    loading: "Aguarde...",
                    months: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
                    weekdays: ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado"],
                    shortMonths: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
                    rangeSelectorFrom: "De",
                    rangeSelectorTo: "Até",
                    rangeSelectorZoom: "Período",
                    decimalPoint: ",",
                    thousandsSep: "."
                },
                s = [{
                    type: "month",
                    count: 1,
                    text: "1m"
                }, {
                    type: "month",
                    count: 3,
                    text: "3m"
                }, {
                    type: "month",
                    count: 6,
                    text: "6m"
                }, {
                    type: "ytd",
                    text: "YTD"
                }, {
                    type: "year",
                    count: 1,
                    text: "1a"
                }, {
                    type: "all",
                    text: "Tudo"
                }],
                n = "{value: %d/%m}";
                break;
            case "es":
            case "es-es":
                t = {
                    loading: "Por favor espere...",
                    months: ["Enero", "Febrero", "Martes", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                    weekdays: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                    shortMonths: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                    rangeSelectorFrom: "De",
                    rangeSelectorTo: "Para",
                    rangeSelectorZoom: "Período",
                    decimalPoint: ",",
                    thousandsSep: "."
                },
                s = [{
                    type: "month",
                    count: 1,
                    text: "1m"
                }, {
                    type: "month",
                    count: 3,
                    text: "3m"
                }, {
                    type: "month",
                    count: 6,
                    text: "6m"
                }, {
                    type: "ytd",
                    text: "YTD"
                }, {
                    type: "year",
                    count: 1,
                    text: "1a"
                }, {
                    type: "all",
                    text: "Todos"
                }],
                n = "{value: %d/%m}";
                break;
            case "zh-hant":
                t = {
                    loading: "請稍等 ...",
                    months: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
                    weekdays: ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"],
                    shortMonths: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
                    rangeSelectorFrom: "從",
                    rangeSelectorTo: "到",
                    rangeSelectorZoom: "時期",
                    decimalPoint: ".",
                    thousandsSep: ","
                },
                s = [{
                    type: "month",
                    count: 1,
                    text: "1月"
                }, {
                    type: "month",
                    count: 3,
                    text: "3月"
                }, {
                    type: "month",
                    count: 6,
                    text: "6月"
                }, {
                    type: "ytd",
                    text: "昨天"
                }, {
                    type: "year",
                    count: 1,
                    text: "1年"
                }, {
                    type: "all",
                    text: "全部"
                }],
                n = "{value: %m/%d}";
                break;
            case "zh-hans":
                t = {
                    loading: "请稍等 ...",
                    months: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
                    weekdays: ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"],
                    shortMonths: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
                    rangeSelectorFrom: "从",
                    rangeSelectorTo: "到",
                    rangeSelectorZoom: "时期",
                    decimalPoint: ".",
                    thousandsSep: ","
                },
                s = [{
                    type: "month",
                    count: 1,
                    text: "1月"
                }, {
                    type: "month",
                    count: 3,
                    text: "3月"
                }, {
                    type: "month",
                    count: 6,
                    text: "6月"
                }, {
                    type: "ytd",
                    text: "昨天"
                }, {
                    type: "year",
                    count: 1,
                    text: "1年"
                }, {
                    type: "all",
                    text: "全部"
                }],
                n = "{value: %m/%d}";
                break;
            case "fr":
                t = {
                    loading: "S'il vous plaît, attendez...",
                    months: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
                    weekdays: ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"],
                    shortMonths: ["Jan", "Fév", "Mar", "Avr", "Peu", "Jui", "Jui", "Aoû", "Sep", "Oct", "Nov", "Déc"],
                    rangeSelectorFrom: "De",
                    rangeSelectorTo: "À",
                    rangeSelectorZoom: "Période",
                    decimalPoint: ".",
                    thousandsSep: ","
                },
                s = [{
                    type: "month",
                    count: 1,
                    text: "1m"
                }, {
                    type: "month",
                    count: 3,
                    text: "3m"
                }, {
                    type: "month",
                    count: 6,
                    text: "6m"
                }, {
                    type: "ytd",
                    text: "hier"
                }, {
                    type: "year",
                    count: 1,
                    text: "1an"
                }, {
                    type: "all",
                    text: "Tout"
                }],
                n = "{value: %m/%d}";
                break;
            case "de":
                t = {
                    loading: "Warten Sie mal...",
                    months: ["Januar", "Februar", "März", "April", "Kann", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"],
                    weekdays: ["Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag"],
                    shortMonths: ["Jan", "Feb", "Mär", "Apr", "Kan", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dez"],
                    rangeSelectorFrom: "Von",
                    rangeSelectorTo: "Zu",
                    rangeSelectorZoom: "Zeitraum",
                    decimalPoint: ".",
                    thousandsSep: ","
                },
                s = [{
                    type: "month",
                    count: 1,
                    text: "1m"
                }, {
                    type: "month",
                    count: 3,
                    text: "3m"
                }, {
                    type: "month",
                    count: 6,
                    text: "6m"
                }, {
                    type: "ytd",
                    text: "Gestern"
                }, {
                    type: "year",
                    count: 1,
                    text: "1j"
                }, {
                    type: "all",
                    text: "Alles"
                }],
                n = "{value: %m/%d}";
                break;
            default:
                t = {
                    loading: "Please, wait...",
                    months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                    weekdays: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                    shortMonths: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    rangeSelectorFrom: "From",
                    rangeSelectorTo: "To",
                    rangeSelectorZoom: "Period",
                    decimalPoint: ".",
                    thousandsSep: ","
                },
                s = [{
                    type: "month",
                    count: 1,
                    text: "1m"
                }, {
                    type: "month",
                    count: 3,
                    text: "3m"
                }, {
                    type: "month",
                    count: 6,
                    text: "6m"
                }, {
                    type: "ytd",
                    text: "YTD"
                }, {
                    type: "year",
                    count: 1,
                    text: "1y"
                }, {
                    type: "all",
                    text: "All"
                }],
                n = "{value: %m/%d}"
            }
            Highcharts.setOptions({
                lang: t
            }),
            a.highstockOptions ? highstockOptions = a.highstockOptions : highstockOptions = {
                chart: {
                    type: chartType,
                    height: chartHeight
                },
                rangeSelector: {
                    enabled: !isSimpleChart,
                    inputEnabled: !isSimpleChart,
                    buttons: s,
                    inputDateFormat: r[e.LANGUAGE].date,
                    inputEditDateFormat: r[e.LANGUAGE].edit
                },
                legend: {
                    enabled: !isSimpleChart
                },
                credits: {
                    enabled: !1
                },
                scrollbar: {
                    enabled: !isSimpleChart
                },
                xAxis: {
                    ordinal: !0,
                    labels: {
                        format: n,
                        type: "datetime",
                        style: {
                            color: "#999999",
                            fontSize: "12px"
                        }
                    }
                },
                yAxis: {
                    labels: {
                        formatter: function() {
                            return (this.value > 0 ? "+" : "") + this.value + "%"
                        },
                        style: {
                            color: "#bbb",
                            fontSize: "11px"
                        }
                    },
                    plotLines: [{
                        value: 0,
                        width: 2,
                        color: "#333333"
                    }]
                },
                navigation: {
                    buttonOptions: {
                        enabled: !isSimpleChart
                    }
                },
                exporting: {
                    buttons: {
                        contextButton: {
                            menuItems: ["printChart", "downloadPNG", "downloadJPEG", "downloadPDF", "downloadSVG"]
                        }
                    }
                },
                navigator: {
                    enabled: !isSimpleChart,
                    handles: {
                        enabled: !isSimpleChart
                    },
                    xAxis: {
                        labels: {
                            style: {
                                color: "#999999",
                                fontSize: "14px"
                            }
                        }
                    }
                },
                plotOptions: {
                    series: {
                        compare: "percent",
                        showInNavigator: !isSimpleChart,
                        dataGrouping: {
                            enabled: !1
                        }
                    },
                    column: {
                        minPointLength: 3
                    }
                },
                tooltip: {
                    formatter: function() {
                        var e = '<span class="highcharts-color-' + this.series.colorIndex + '">' + Highcharts.dateFormat("%A, %e %B, %Y", new Date(this.x)) + '</span><br/><span class="highcharts-color-"' + this.series.colorIndex + ">" + this.series.name + "</span>: " + Highcharts.numberFormat(this.y, 2) + " (" + Highcharts.numberFormat(this.point.change, 2) + "%)";
                        return e
                    },
                    valueDecimals: 2,
                    split: !1
                },
                series: void 0
            }
        }(a),
        M(a)
    }
    function M(a) {
        var s = e.API_URL + "/" + e.STOCK_ID + "/graphic?from=" + e.START_DATE.format("YYYY-MM-DD") + "&to=" + e.END_DATE.format("YYYY-MM-DD") + "&tickers=" + e.TICKER + "&adjusted=" + e.ADJUSTED;
        void 0 !== e.INDEXES && (s += "&indexes=" + e.INDEXES),
        $.ajax({
            url: s,
            type: "GET",
            dataType: "json",
            success: function(s) {
                isSimpleChart || function(a, s) {
                    var l = {
                        pt: {
                            max: "Máximo: ",
                            min: "Mínimo: ",
                            max52: "Máx52: ",
                            min52: "Mín52: ",
                            open: "Abertura: ",
                            vol: "Volume: ",
                            title: "Títulos: ",
                            business: "Negócios: ",
                            update: "Última atualização: ",
                            line: "Linha",
                            bar: "Barra",
                            area: "Área",
                            month: "mês",
                            months: "meses",
                            year: "ano",
                            years: "anos",
                            source: "Fonte: "
                        },
                        "pt-br": {
                            max: "Máximo: ",
                            min: "Mínimo: ",
                            max52: "Máx52: ",
                            min52: "Mín52: ",
                            open: "Abertura: ",
                            vol: "Volume: ",
                            title: "Títulos: ",
                            business: "Negócios: ",
                            update: "Última atualização: ",
                            line: "Linha",
                            bar: "Barra",
                            area: "Área",
                            month: "mês",
                            months: "meses",
                            year: "ano",
                            years: "anos",
                            source: "Fonte: "
                        },
                        es: {
                            max: "Máximo: ",
                            min: "Mínimo: ",
                            max52: "Máx52: ",
                            min52: "Mín52: ",
                            open: "Apertura: ",
                            vol: "Volumen: ",
                            title: "Titulos: ",
                            business: "Negocios: ",
                            update: "Última atualización: ",
                            line: "Linea",
                            bar: "Barra",
                            area: "Area",
                            month: "mes",
                            months: "meses",
                            year: "año",
                            years: "años",
                            source: "Fuente: "
                        },
                        "es-es": {
                            max: "Máximo: ",
                            min: "Mínimo: ",
                            max52: "Máx52: ",
                            min52: "Mín52: ",
                            open: "Apertura: ",
                            vol: "Volumen: ",
                            title: "Titulos: ",
                            business: "Negocios: ",
                            update: "Última atualización: ",
                            line: "Linea",
                            bar: "Barra",
                            area: "Area",
                            month: "mes",
                            months: "meses",
                            year: "año",
                            years: "años",
                            source: "Fuente: "
                        },
                        en: {
                            max: "Maximum: ",
                            min: "Minimal: ",
                            max52: "Max52: ",
                            min52: "Min52: ",
                            open: "Open: ",
                            vol: "Volume: ",
                            title: "Shares: ",
                            business: "Trades: ",
                            update: "Last update: ",
                            line: "Line",
                            bar: "Bar",
                            area: "Area",
                            month: "month",
                            months: "months",
                            year: "year",
                            years: "years",
                            source: "Source: "
                        },
                        "zh-hant": {
                            max: "最大限度: ",
                            min: "最低限度: ",
                            max52: "最多52: ",
                            min52: "最低52: ",
                            open: "開場: ",
                            vol: "體積: ",
                            title: "職稱: ",
                            business: "商業: ",
                            update: "最後更新: ",
                            line: "線",
                            bar: "酒吧",
                            area: "區域",
                            month: "月",
                            months: "月",
                            year: "年",
                            years: "歲",
                            source: "來源: "
                        },
                        "zh-hans": {
                            max: "最大限度: ",
                            min: "最低限度: ",
                            max52: "最多52: ",
                            min52: "最低52: ",
                            open: "开场: ",
                            vol: "体积: ",
                            title: "职称: ",
                            business: "商业: ",
                            update: "最后更新: ",
                            line: "线",
                            bar: "酒吧",
                            area: "区域",
                            month: "月",
                            months: "月",
                            year: "年",
                            years: "岁",
                            source: "来源: "
                        },
                        fr: {
                            max: "Maximum: ",
                            min: "Minimal: ",
                            max52: "Max52: ",
                            min52: "Min52: ",
                            open: "Ouvert: ",
                            vol: "Le volume: ",
                            title: "Actions: ",
                            business: "Métiers: ",
                            update: "Dernière mise à jour: ",
                            line: "Ligne",
                            bar: "Bar",
                            area: "Surface",
                            month: "mois",
                            months: "mois",
                            year: "an",
                            years: "années",
                            source: "La source: "
                        },
                        de: {
                            max: "Maximum: ",
                            min: "Minimal: ",
                            max52: "Max52: ",
                            min52: "Min52: ",
                            open: "Öffnen: ",
                            vol: "Volumen: ",
                            title: "Anteile: ",
                            business: "Trades: ",
                            update: "Letztes Update: ",
                            line: "Linie",
                            bar: "Bar",
                            area: "Bereich",
                            month: "Monat",
                            months: "Monate",
                            year: "Jahr",
                            years: "Jahre",
                            source: "Quelle: "
                        }
                    }
                      , o = "line" === highstockOptions.chart.type ? "active" : ""
                      , c = "column" === highstockOptions.chart.type ? "active" : ""
                      , m = "area" === highstockOptions.chart.type ? "active" : ""
                      , d = '<div id="chart-stockinfo" class="chart"><div class="loading-content"><div class="loading"></div></div><div id="tableChart"><ul class="tbPrices"><li class="tbPrices__title"><span class="ticker">-</span><div class="dateReference">' + l[e.LANGUAGE].update + '<span class="last-date">-</span></div></li><li class="tbPrices__price"><span class="preco"><span class="price">-</span><br><span class="variation"><span class="parenthesis">(</span> <span class="vari">-</span> <span class="parenthesis">)</span></span></span></li><li class="tbPrices__column"><div class="tbPrices__column-box first"><span class="label">' + l[e.LANGUAGE].max + '</span><span class="maxima value"><span class="max">-</span></span></div><div class="tbPrices__column-box"><span class="label">' + l[e.LANGUAGE].min + '</span><span class="minima value"><span class="min">-</span></span></div></li><li class="tbPrices__column"><div class="tbPrices__column-box first"><span class="label">' + l[e.LANGUAGE].open + '</span><span class="value down"><span class="open">-</span></span></div><div class="tbPrices__column-box"><span class="label">' + l[e.LANGUAGE].vol + '</span><span class="value"><span class="vol">-</span></span><div></li><li class="tbPrices__column"><div class="tbPrices__column-box first"><span class="label">' + l[e.LANGUAGE].max52 + ': </span><span class="value down"><span class="max52">-</span></span></div><div class="tbPrices__column-box"><span class="label">' + l[e.LANGUAGE].min52 + ': </span><span class="value down"><span class="min52">-</span></span><div></li><li class="tbPrices__column"><div class="tbPrices__column-box first"><span class="label">' + l[e.LANGUAGE].business + '</span><span class="value"><span class="trade">-</span></span></div><div class="tbPrices__column-box"><span class="label">' + l[e.LANGUAGE].title + '</span><span class="value"><span class="share">-</span></span><div></li></ul></div><div id="container-chart" style="width: 100%"></div><div class="btns hide"><input type="button" id="chart-type-line" data-chart-type="line" class="btn-change-chart-type ' + o + '" value="' + l[e.LANGUAGE].line + '" /><input type="button" id="chart-type-column" data-chart-type="column" class="btn-change-chart-type ' + c + '" value="' + l[e.LANGUAGE].bar + '" /><input type="button" id="chart-type-area" data-chart-type="area" class="btn-change-chart-type ' + m + '" value="' + l[e.LANGUAGE].area + '" style="margin-right: 50px" /><input type="button" id="btn-period-1m" data-chart-period="1m" class="btn-change-chart-period active" value="1 ' + l[e.LANGUAGE].month + '" /><input type="button" id="btn-period-6m" data-chart-period="6m" class="btn-change-chart-period" value="6 ' + l[e.LANGUAGE].months + '" /><input type="button" id="btn-period-1y" data-chart-period="1y" class="btn-change-chart-period" value="1 ' + l[e.LANGUAGE].year + '" /><input type="button" id="btn-period-3y" data-chart-period="3y" class="btn-change-chart-period" value="3 ' + l[e.LANGUAGE].years + '" /><input type="button" id="btn-period-5y" data-chart-period="5y" class="btn-change-chart-period" value="5 ' + l[e.LANGUAGE].years + '" /></div><div class="table-footer"><div class="footer">' + l[e.LANGUAGE].source + '<span class="link"><a target="_blank" id="sourceLink"></a></span></div></div></div>';
                    $(e.rootElement).append(d),
                    $(".btn-change-chart-type").on("click", function(a) {
                        !function(a) {
                            $DOCUMENT.querySelector("#chart-type-line").classList.remove("active"),
                            $DOCUMENT.querySelector("#chart-type-column").classList.remove("active"),
                            $DOCUMENT.querySelector("#chart-type-area").classList.remove("active"),
                            {
                                line: function() {
                                    $DOCUMENT.querySelector("#chart-type-line").classList.add("active")
                                },
                                column: function() {
                                    $DOCUMENT.querySelector("#chart-type-column").classList.add("active")
                                },
                                area: function() {
                                    $DOCUMENT.querySelector("#chart-type-area").classList.add("active")
                                }
                            }[a](),
                            highstockOptions.chart.type = a;
                            $(e.rootElement).find("#container-chart");
                            Highcharts.stockChart("container-chart", highstockOptions)
                        }($(a.target).data("chart-type"))
                    }),
                    $(".btn-change-chart-period").on("click", function(a) {
                        !function(a, t) {
                            e.END_DATE = moment(),
                            {
                                "1m": function() {
                                    e.START_DATE = moment().subtract(1, "months"),
                                    e.CHART_PERIOD = "1m"
                                },
                                "6m": function() {
                                    e.START_DATE = moment().subtract(6, "months"),
                                    e.CHART_PERIOD = "6m"
                                },
                                "1y": function() {
                                    e.START_DATE = moment().subtract(1, "years"),
                                    e.CHART_PERIOD = "1y"
                                },
                                "3y": function() {
                                    e.START_DATE = moment().subtract(3, "years"),
                                    e.CHART_PERIOD = "3y"
                                },
                                "5y": function() {
                                    e.START_DATE = moment().subtract(5, "years"),
                                    e.CHART_PERIOD = "5y"
                                }
                            }[a](),
                            N(a),
                            M(t)
                        }($(a.target).data("chart-period"), s)
                    });
                    var p = void 0
                      , u = $DOCUMENT.querySelector("#tableChart");
                    a.tickers.length > 0 ? p = a.tickers[0] : a.indexes.length > 0 && (p = a.indexes[0]);
                    s.tickers && -1 == s.tickers.indexOf(",") && (p = a.tickers.filter(function(e) {
                        return e.ticker === s.tickers
                    })[0]);
                    if (!p)
                        return;
                    var h = "down"
                      , b = "";
                    p.info.var > 0 && (h = "up",
                    b = "+");
                    0 === p.info.var && (h = "neutro");
                    var v = n(p.info.var);
                    "-" !== v && (v = b + v + " %");
                    u.querySelector(".variation").classList.add(h),
                    u.querySelector(".ticker").innerHTML = p.ticker,
                    u.querySelector(".last-date").innerHTML = i([p]),
                    u.querySelector(".price").innerHTML = n(p.info.price, !0),
                    u.querySelector(".vari").innerHTML = v,
                    u.querySelector(".max").innerHTML = n(p.info.high, !0),
                    u.querySelector(".min").innerHTML = n(p.info.low, !0),
                    u.querySelector(".open").innerHTML = n(p.info.open, !0),
                    u.querySelector(".vol").innerHTML = !0 === e.HAS_SHORT_MODE ? t(p.info.vol) : r(p.info.vol, !1),
                    u.querySelector(".max52").innerHTML = n(p.info.max52, !0),
                    u.querySelector(".min52").innerHTML = n(p.info.min52, !0),
                    u.querySelector(".trade").innerHTML = !0 === e.HAS_SHORT_MODE ? t(p.info.trade) : r(p.info.trade, !1),
                    u.querySelector(".share").innerHTML = !0 === e.HAS_SHORT_MODE ? t(p.info.share) : r(p.info.share, !1)
                }(s.data.live, a),
                function(a, t) {
                    var s = a.data.history
                      , n = []
                      , r = !0
                      , i = {
                        pt: {
                            max: "Máximo: ",
                            min: "Mínimo: ",
                            open: "Abertura: ",
                            vol: "Volume: "
                        },
                        "pt-br": {
                            max: "Máximo: ",
                            min: "Mínimo: ",
                            open: "Abertura: ",
                            vol: "Volume: "
                        },
                        es: {
                            max: "Máximo: ",
                            min: "Mínimo: ",
                            open: "Apertura: ",
                            vol: "Volumen: "
                        },
                        "es-es": {
                            max: "Máximo: ",
                            min: "Mínimo: ",
                            open: "Apertura: ",
                            vol: "Volumen: "
                        },
                        en: {
                            max: "Maximum: ",
                            min: "Minimal: ",
                            open: "Open: ",
                            vol: "Close: "
                        },
                        "zh-hant": {
                            max: "最大限度: ",
                            min: "最低限度: ",
                            open: "開場: ",
                            vol: "體積: "
                        },
                        "zh-hans": {
                            max: "最大限度: ",
                            min: "最低限度: ",
                            open: "开场: ",
                            vol: "体积: "
                        },
                        fr: {
                            max: "Maximum: ",
                            min: "Minimal: ",
                            open: "Ouvert: ",
                            vol: "Fermer: "
                        },
                        de: {
                            max: "Maximum: ",
                            min: "Minimal: ",
                            open: "Öffnen: ",
                            vol: "Schließen: "
                        }
                    }
                      , l = '<div id="chart-stockinfo" class="chart"><div class="loading-content"><div class="loading"></div></div><div id="tableChart"><ul class="tbPrices simple-chart"><li class="tbPrices__title"><span class="ticker">-</span><div class="dateReference">Última atualização: <span class="last-date">-</span></div></li><li class="tbPrices__price"><span class="preco"><span class="price">-</span><br><span class="variation down"><span class="parenthesis">(</span><span class="vari">-</span>%<span class="parenthesis">)</span></span></span></li><li class="tbPrices__column"><div class="tbPrices__column-box first"><span class="label">Máximo: </span><span class="maxima value"><span class="max">-</span></span></div><div class="tbPrices__column-box"><span class="label">Mínimo: </span><span class="minima value"><span class="min">-</span></span></div></li><li class="tbPrices__column"><div class="tbPrices__column-box first"><span class="label">Abertura: </span><span class="value down"><span class="open">-</span></span></div><div class="tbPrices__column-box"><span class="label">Volume: </span><span class="value"><span class="vol">-</span></span><div></li><li class="tbPrices__column"><div class="tbPrices__column-box first"><span class="label">' + i[e.LANGUAGE].max52 + ': </span><span class="value down"><span class="max52">-</span></span></div><div class="tbPrices__column-box"><span class="label">' + i[e.LANGUAGE].min52 + ': </span><span class="value down"><span class="min52">-</span></span><div></li><li class="tbPrices__column"><div class="tbPrices__column-box first"><span class="label">Negócios: </span><span class="value"><span class="trade">-</span></span></div><div class="tbPrices__column-box"><span class="label">Títulos: </span><span class="value"><span class="share">-</span></span><div></li></ul></div><div id="container-chart" style="width: 100%"></div><div class="btns hide simple-chart"><input type="button" id="chart-type-line" class="btn-change-chart-type active" value="Linha" onclick="changeChartType("line")" /><input type="button" id="chart-type-column" class="btn-change-chart-type" value="Barra" onclick="changeChartType("column")" /><input type="button" id="chart-type-area" class="btn-change-chart-type" value="Área" onclick="changeChartType("area")" style="margin-right: 50px" /><input type="button" id="btn-period-1m" class="btn-change-chart-period active" value="1 mês" onclick="changeChartPeriod("1m")" /><input type="button" id="btn-period-6m" class="btn-change-chart-period" value="6 meses" onclick="changeChartPeriod("6m")" /><input type="button" id="btn-period-1y" class="btn-change-chart-period" value="1 ano" onclick="changeChartPeriod("1y")" /><input type="button" id="btn-period-3y" class="btn-change-chart-period" value="3 anos" onclick="changeChartPeriod("3y")" /><input type="button" id="btn-period-5y" class="btn-change-chart-period" value="5 anos" onclick="changeChartPeriod("5y")" /></div><div class="table-footer"><div class="footer">Fonte: <span class="link"><a target="_blank" id="sourceLink"></a></span></div></div></div>';
                    $(e.rootElement).append(l);
                    var o = s.tickers.map(function(a) {
                        var t = a.history.map(function(e) {
                            return [Number(moment.utc(e.date, "YYYY-MM-DD").format("x")), Number(e.closed)]
                        });
                        t = t.reverse();
                        var s = {
                            name: a.ticker,
                            data: t,
                            visible: !!r,
                            currencySymbol: e.CURRENCY_SYMBOL
                        };
                        return r = !1,
                        s
                    })
                      , c = s.indexes.map(function(e) {
                        var a = e.history.map(function(e) {
                            return [Number(moment.utc(e.date, "YYYY-MM-DD").format("x")), Number(e.closed)]
                        });
                        a = a.reverse();
                        var t = {
                            name: e.ticker,
                            data: a,
                            visible: !!r,
                            currencySymbol: ""
                        };
                        return r = !1,
                        t
                    });
                    [].push.apply(n, o),
                    [].push.apply(n, c);
                    for (var m = 0; m < n.length; m++)
                        chartColors.length >= m + 1 && (n[m].color = chartColors[m]);
                    highstockOptions.series = n,
                    Highcharts.stockChart("container-chart", highstockOptions);
                    var d = $DOCUMENT.querySelector("#sourceLink");
                    d.innerHTML = s.source,
                    d.href = s.link,
                    $(e.rootElement).find(".chart").each(function(e, a) {
                        0 !== e && $(a).remove()
                    }),
                    N(e.CHART_PERIOD)
                }(s),
                $DOCUMENT.querySelector(".loading-content").classList.add("hide")
            },
            error: function(e) {
                console.warn("Não foi possível recuperar os dados do gráfico. Tente novamente ou contate o suporte!"),
                console.error("Erro ao recuperar dados da API: "),
                console.warn(e)
            }
        })
    }
    function N(e) {
        $DOCUMENT.querySelector(".loading-content").classList.remove("hide"),
        $DOCUMENT.querySelector("#btn-period-1m").classList.remove("active"),
        $DOCUMENT.querySelector("#btn-period-6m").classList.remove("active"),
        $DOCUMENT.querySelector("#btn-period-1y").classList.remove("active"),
        $DOCUMENT.querySelector("#btn-period-3y").classList.remove("active"),
        $DOCUMENT.querySelector("#btn-period-5y").classList.remove("active"),
        {
            "1m": function() {
                $DOCUMENT.querySelector("#btn-period-1m").classList.add("active")
            },
            "6m": function() {
                $DOCUMENT.querySelector("#btn-period-6m").classList.add("active")
            },
            "1y": function() {
                $DOCUMENT.querySelector("#btn-period-1y").classList.add("active")
            },
            "3y": function() {
                $DOCUMENT.querySelector("#btn-period-3y").classList.add("active")
            },
            "5y": function() {
                $DOCUMENT.querySelector("#btn-period-5y").classList.add("active")
            }
        }[e]()
    }
    e.rootElement = void 0,
    e.INDEXES = void 0,
    e.ARROW_IMAGES = void 0,
    e.SHOW_VARIATION_ARROW = !0,
    e.HAS_SHORT_MODE = !1,
    e.IS_SIMPLE_CHART = void 0,
    e.HIGHSTOCK_OPTIONS = void 0,
    e.CHART_HEIGHT = void 0,
    e.CHART_COLORS = void 0,
    e.CHART_TYPE = void 0,
    e.CHART_PERIOD = "1m",
    e.CHART_STOCKS = void 0,
    e.SWITCH_TICKER_INDEX = void 0,
    e.END_DATE = moment(),
    e.START_DATE = moment().subtract(1, "months"),
    e.IS_INDEX = void 0,
    e.TICKER = void 0,
    e.CURRENCY_SYMBOL = void 0,
    e.DATEPICKER_DATE_FORMAT = void 0,
    e.DECIMAL_PLACES = 2,
    e.MOMENT_DATE_FORMAT = void 0,
    e.LANGUAGE = void 0,
    e.STOCK_ID = void 0,
    e.ADJUSTED = !1,
    e.API_URL = "https://apicatalog.mziq.com/stockinfo",
    e.initialize = function(a, t) {
        return e.HAS_SHORT_MODE = !!a.shortMode && a.shortMode,
        e.SHOW_VARIATION_ARROW = void 0 === a.template.showVariationArrow || a.template.showVariationArrow,
        e.ARROW_IMAGES = void 0 === a.template.arrowImages ? void 0 : a.template.arrowImages,
        e.DECIMAL_PLACES = a.decimalPlaces ? a.decimalPlaces : 2,
        e.INDEXES = a.indexes ? a.indexes : void 0,
        e.rootElement = $DOCUMENT.querySelector(t),
        {
            raw: function() {
                l(a, a.rawInit)
            },
            live: function() {
                l(a, function(t) {
                    t ? function(a, t) {
                        var s = []
                          , l = $DOCUMENT.createElement("table")
                          , o = void 0;
                        switch ([].push.apply(s, a.tickers.map(function(e) {
                            return e.isIndex = !1,
                            e
                        })),
                        [].push.apply(s, a.indexes.map(function(e) {
                            return e.isIndex = !0,
                            e
                        })),
                        l.setAttribute("id", "stockinfo-live-table"),
                        $(e.rootElement).append(l),
                        e.LANGUAGE) {
                        case "pt":
                        case "pt-br":
                            o = "<th class='ticker'>Asset</td>";
                            break;
                        case "es":
                        case "es-es":
                            o = "<th class='ticker'>Activo</td>";
                            break;
                        case "zh-hant":
                            o = "<th class='ticker'>積極的</td>";
                            break;
                        case "zh-hans":
                            o = "<th class='ticker'>积极的</td>";
                            break;
                        case "fr":
                            o = "<th class='ticker'>Actif</td>";
                            break;
                        case "de":
                            o = "<th class='ticker'>Anlagegut</td>";
                            break;
                        default:
                            o = "<th class='ticker'>Asset</td>"
                        }
                        $(l).append(c(t)),
                        $(l).find("thead tr").prepend(o);
                        var d = function() {
                            if (t.template.preffix) {
                                var e = t.template.preffix.filter(function(e) {
                                    return "ticker" === e.field
                                });
                                return e.length > 0 ? e[0].symbol : ""
                            }
                            return ""
                        }
                          , p = function() {
                            if (t.template.suffix) {
                                var e = t.template.suffix.filter(function(e) {
                                    return "ticker" === e.field
                                });
                                return e.length > 0 ? e[0].symbol : ""
                            }
                            return ""
                        };
                        s.map(function(a) {
                            var s = "up";
                            a.info.var < 0 && (s = "down");
                            a.isIndex ? r(a.info.price) : n(a.info.price, !0),
                            n(a.info.var, !1),
                            r(a.info.vol);
                            var i = document.createElement("tr");
                            if ($(l).append(i),
                            t.template.tickerLink && t.template.tickerLink[a.ticker] ? $(i).append('<td class="ticker"><a href="' + t.template.tickerLink[a.ticker][e.LANGUAGE] + '" target="_blank">' + d() + a.ticker + p() + "</a></td>") : $(i).append('<td class="ticker">' + d() + a.ticker + p() + "</td>"),
                            Object.keys(a.info).forEach(function(e) {
                                if (t.template.columns && !t.template.columns.includes(e))
                                    return !1;
                                $(i).append('<td class="' + u(e, s) + '">' + v(t, e) + h(e, a.info[e], s, a.isIndex) + f(t, e) + "</td>")
                            }),
                            t.template.customArrow)
                                if (void 0 !== e.ARROW_IMAGES) {
                                    var o;
                                    a.info.var < 0 ? o = e.ARROW_IMAGES.down : a.info.var > 0 ? o = e.ARROW_IMAGES.up : 0 === a.info.var && (o = e.ARROW_IMAGES.neutral),
                                    $(i).append('<td class="arrow custom-arrow-td"><img class="custom-arrow-image" src="' + o + '"></img></td>')
                                } else {
                                    var c = a.info.var < 0 ? "down" : "up";
                                    $(i).append('<td class="arrow custom-arrow-td"><span class="custom-arrow-default ' + c + '"></span></td>')
                                }
                        });
                        var A = function(e) {
                            return !(!t.customLabels || !t.customLabels[e]) && t.customLabels[e]
                        }
                          , M = !1 !== A("arrow") ? A("arrow") : "Arrow";
                        t.template.customArrow && ($("th.arrow.custom-arrow").remove(),
                        $(l).find("thead tr").append('<th class="arrow custom-arrow">' + M + "</th>"));
                        !0 === t.highlight && function(a, t) {
                            var s = a.tickers[0]
                              , i = s.info.var > 0 ? "up" : "down"
                              , l = '<div class="highlight ticker element-wrapper"><span class="value">' + n(s.info.price, !0) + '</span><div class="infos-wrapper"><span class="ticker"><span class="pref ticker-name">' + {
                                pt: "Ativo: ",
                                en: "Asset: ",
                                es: "Activo: ",
                                "zh-hant": "積極的: ",
                                "zh-hans": "积极的: ",
                                fr: "Actif:",
                                de: "Anlagegut:"
                            }[t] + " </span>" + s.ticker + '</span><span class="variation ' + i + '"><span class="pref variation-name">' + {
                                pt: "Variação:",
                                en: "Variation:",
                                es: "Variación:",
                                "zh-hant": "變化:",
                                "zh-hans": "变化:",
                                fr: "Variation:",
                                de: "Variation:"
                            }[t] + " </span>" + r(s.info.var, !0) + "%</span></div></div>";
                            $(e.rootElement).prepend(l),
                            $("#stockinfo-live-table tbody tr:eq(0)").hide()
                        }(a, t.language);
                        m(t);
                        var N = i(s)
                          , E = "<tr class='footer'><td colspan='4'>" + N + {
                            pt: " - Atraso de 15 min.",
                            en: " - 15 min. delay",
                            es: " - 15 min. de retraso",
                            "zh-hant": " - 延遲15分鐘",
                            "zh-hans": " - 延迟15分钟",
                            fr: "15 minutes retard.",
                            de: "15 Minuten verzögern."
                        }[e.LANGUAGE] + " | " + {
                            pt: "Fonte: ",
                            en: "Source: ",
                            es: "Fuente: ",
                            "zh-hant": "來源: ",
                            "zh-hans": "来源: ",
                            fr: "La source: ",
                            de: "Quelle: "
                        }[e.LANGUAGE] + '<a href="' + a.link + '" target="_blank">' + a.source + "</a>";
                        $(l).append(E),
                        b(t)
                    }(t, a) : console.error("Não foi possível recuperar os dados das cotações. Tente novamente ou contate o suporte!")
                })
            },
            chart: function() {
                A(a)
            },
            simpleChart: function() {
                A(a)
            },
            history: function() {
                !function(a) {
                    (function(a) {
                        e.STOCK_ID = a.stockinfoId,
                        e.TICKER = a.tickers,
                        e.IS_INDEX = a.isIndex,
                        e.LANGUAGE = a.language ? a.language : "pt",
                        e.ADJUSTED = a.adjusted ? a.adjusted : e.ADJUSTED,
                        a.startDate && (e.START_DATE = moment(a.startDate, "YYYY-MM-DD"));
                        a.endDate && (e.END_DATE = moment(a.endDate, "YYYY-MM-DD"));
                        switchTickerIndex = e.IS_INDEX ? "&indexes=" + e.TICKER : "&tickers=" + e.TICKER,
                        e.MOMENT_DATE_FORMAT = "pt" === a.language || "es" === a.language ? "DD/MM/YYYY" : "MM/DD/YYYY",
                        e.DATEPICKER_DATE_FORMAT = "pt" === a.language || "es" === a.language ? "dd/mm/yy" : "mm/dd/yy",
                        e.CURRENCY_SYMBOL = a.currencySymbol ? a.currencySymbol : "R$",
                        e.DECIMAL_PLACES = a.decimalPlaces ? a.decimalPlaces : 2;
                        var t = {
                            pt: {
                                startDate: "Data inicial:",
                                endDate: "Data final:",
                                interval: "Intervalo máximo: 10 anos",
                                search: "Pesquisar",
                                excel: "Exportar",
                                source: "Fonte"
                            },
                            "pt-br": {
                                startDate: "Data inicial:",
                                endDate: "Data final:",
                                interval: "Intervalo máximo: 10 anos",
                                search: "Pesquisar",
                                excel: "Exportar",
                                source: "Fonte"
                            },
                            es: {
                                startDate: "Fecha de inicio:",
                                endDate: "Fecha final:",
                                interval: "Intervalo máximo: 10 años",
                                excel: "Exportación",
                                search: "Buscar",
                                source: "Fuente"
                            },
                            "es-es": {
                                startDate: "Fecha de inicio:",
                                endDate: "Fecha final:",
                                interval: "Intervalo máximo: 10 años",
                                excel: "Exportación",
                                search: "Buscar",
                                source: "Fuente"
                            },
                            en: {
                                startDate: "Initial date:",
                                endDate: "Final date:",
                                interval: "Maximal delay: 10 years",
                                search: "Search",
                                excel: "Export",
                                source: "Source"
                            },
                            "zh-hant": {
                                startDate: "初始日期：",
                                endDate: "截止日期：",
                                interval: "最長間隔：10年",
                                search: "搜索",
                                excel: "出口",
                                source: "來源"
                            },
                            "zh-hans": {
                                startDate: "初始日期：",
                                endDate: "截止日期：",
                                interval: "最长间隔：10年",
                                search: "搜索",
                                excel: "出口",
                                source: "来源"
                            },
                            fr: {
                                startDate: "La date initiale:",
                                endDate: "Date finale:",
                                interval: "Délai maximal: 10 ans",
                                search: "Chercher",
                                excel: "Exportation",
                                source: "La source"
                            },
                            de: {
                                startDate: "Anfangsdatum:",
                                endDate: "Endgültiges Datum:",
                                interval: "Maximale Verzögerung: 10 Jahre",
                                search: "Suche",
                                excel: "Export",
                                source: "Quelle"
                            }
                        }
                          , s = '<div class="mziq-quotations"><div class="scroll"><div class="ticker-infos historyTabularPrices"><div class="historyTickerIdentification"></div><form  id="historyForm"><div class="form-inline"><div class="first"><label for="txtStartDate">' + t[e.LANGUAGE].startDate + '</label><input type="text" id="txtStartDate" name="txtStartDate" class="form-control mr20"></div><div><label for="txtEndDate">' + t[e.LANGUAGE].endDate + '</label><input type="text" id="txtEndDate" name="txtEndDate" class="form-control"></div><div class="last"><button id="btnSearchHistory" class="btn btn-default">' + t[e.LANGUAGE].search + '</button><a class="btn btn-close" href=""><i class="fa fa-close"></i></a><label class="info">* ' + t[e.LANGUAGE].interval + '</label></div><a href="#" id="btnExportToExcel" class="btn btn-export">' + t[e.LANGUAGE].excel + '</a></div></form><table class="table__history" cellspacing="0" cellpadding="0">' + c(a) + '<tbody><tr class="loading"><td colspan="10"></td></tr></tbody><tfoot><tr><td colspan="10" class="fonte" id="source">' + t[e.LANGUAGE].source + ': <a href="http://www.enfoque.com.br/" target="_blank">Enfoque</a></td></tr></tfoot></table></div></div></div>';
                        $(e.rootElement).append(s),
                        $(".historyTickerIdentification").html(e.TICKER)
                    }
                    )(a),
                    function(a) {
                        var t = $("#btnSearchHistory")
                          , s = {
                            wrong_date: {
                                pt: "Data inicial deve ser menor ou igual a data final!",
                                "pt-br": "Data inicial deve ser menor ou igual a data final!",
                                es: "¡La fecha inicial debe ser menor o igual a la fecha final!",
                                "es-es": "¡La fecha inicial debe ser menor o igual a la fecha final!",
                                en: "Initial date must be minor or equal than the final date!",
                                "zh-hant": "開始日期必須小於或等於結束日期！",
                                "zh-hans": "开始日期必须小于或等于结束日期！",
                                fr: "La date initiale doit être mineure ou égale à la date finale!",
                                de: "Das Anfangsdatum muss geringfügig oder gleich dem Enddatum sein!"
                            },
                            all_fields: {
                                pt: "Preencha todos os campos de data!",
                                "pt-br": "Preencha todos os campos de data!",
                                es: "Por favor, rellene todos los campos de fecha!",
                                "es-es": "Por favor, rellene todos los campos de fecha!",
                                en: "Please, fill all date fields!",
                                "zh-hant": "填寫所有日期字段！",
                                "zh-hans": "填写所有日期字段！",
                                fr: "Veuillez remplir tous les champs de date!",
                                de: "Bitte füllen Sie alle Datumsfelder aus!"
                            }
                        };
                        t.on("click", function(t) {
                            return t && t.preventDefault(),
                            e.START_DATE > e.END_DATE ? (alert(s.wrong_date[a.language]),
                            void console.error(s.wrong_date[a.language])) : "" === $("#txtStartDate").val() || "" === $("#txtEndDate").val() ? (alert(s.all_fields[a.language]),
                            void console.error(s.all_fields[a.language])) : (p(!0),
                            void d(a))
                        })
                    }(a),
                    $("#btnExportToExcel").on("click", function(a) {
                        a && a.preventDefault(),
                        "pt-br" === e.LANGUAGE || "pt" === e.LANGUAGE ? langIdiom = "1" : "es" === e.LANGUAGE ? langIdiom = "1" : "zh-hans" === e.LANGUAGE ? langIdiom = "2" : "zh-hant" === e.LANGUAGE ? langIdiom = "3" : "fr-fr" === e.LANGUAGE || "fr" === e.LANGUAGE ? langIdiom = "4" : "de-de" === e.LANGUAGE || "de" === e.LANGUAGE ? langIdiom = "5" : langIdiom = "0";
                        var t = langIdiom;
                        window.open(e.API_URL + "/" + e.STOCK_ID + "/historyToExcel?from=" + e.START_DATE.format("YYYY-MM-DD") + "&to=" + e.END_DATE.format("YYYY-MM-DD") + switchTickerIndex + "&idiom=" + t + "&adjusted=" + e.ADJUSTED, "_blank")
                    }),
                    d(a),
                    function() {
                        var a = $("#txtStartDate");
                        a.val(e.START_DATE.format(e.MOMENT_DATE_FORMAT)),
                        a.datepicker({
                            changeMonth: !0,
                            changeYear: !0,
                            numberOfMonths: 1,
                            dateFormat: e.DATEPICKER_DATE_FORMAT,
                            maxDate: 0,
                            minDate: "-10Y",
                            onSelect: function(a, t) {
                                e.START_DATE = moment(a, e.MOMENT_DATE_FORMAT)
                            }
                        });
                        var t = $("#txtEndDate");
                        t.val(e.END_DATE.format(e.MOMENT_DATE_FORMAT)),
                        t.datepicker({
                            changeMonth: !0,
                            changeYear: !0,
                            numberOfMonths: 1,
                            dateFormat: e.DATEPICKER_DATE_FORMAT,
                            maxDate: 0,
                            minDate: "-10Y",
                            onSelect: function(a, t) {
                                e.END_DATE = moment(a, e.MOMENT_DATE_FORMAT)
                            }
                        })
                    }();
                    $("header");
                    var t = document.createElement("script");
                    ({
                        pt: function() {
                            t.src = "https://s3.amazonaws.com/mz-prd-stockinfo/assets/js/datepicker/datepicker-pt-BR.js",
                            document.head.appendChild(t)
                        },
                        "pt-br": function() {
                            t.src = "https://s3.amazonaws.com/mz-prd-stockinfo/assets/js/datepicker/datepicker-pt-BR.js",
                            document.head.appendChild(t)
                        },
                        es: function() {
                            t.src = "https://s3.amazonaws.com/mz-prd-stockinfo/assets/js/datepicker/datepicker-es.js",
                            document.head.appendChild(t)
                        },
                        "es-es": function() {
                            t.src = "https://s3.amazonaws.com/mz-prd-stockinfo/assets/js/datepicker/datepicker-es.js",
                            document.head.appendChild(t)
                        },
                        en: function() {
                            t.src = "https://s3.amazonaws.com/mz-prd-stockinfo/assets/js/datepicker/datepicker-en-GB.js",
                            document.head.appendChild(t)
                        },
                        "zh-hant": function() {
                            t.src = "https://mz-prd-stockinfo.s3.amazonaws.com/assets/js/datepicker/datepicker-zh-TW.js",
                            document.head.appendChild(t)
                        },
                        "zh-hans": function() {
                            t.src = "https://mz-prd-stockinfo.s3.amazonaws.com/assets/js/datepicker/datepicker-zh-CN.js",
                            document.head.appendChild(t)
                        },
                        fr: function() {
                            t.src = "https://s3.amazonaws.com/mz-prd-stockinfo/assets/js/datepicker/datepicker-fr-FR.js",
                            document.head.appendChild(t)
                        },
                        de: function() {
                            t.src = "https://s3.amazonaws.com/mz-prd-stockinfo/assets/js/datepicker/datepicker-de-DE.js",
                            document.head.appendChild(t)
                        }
                    })[a.language]()
                }(a)
            }
        }[a.template.type]()
    }
}
