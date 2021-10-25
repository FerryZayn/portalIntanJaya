<script>
    if (navigator.userAgent.match(/MSIE|Internet Explorer/i) || navigator.userAgent.match(/Trident\/7\..*?rv:11/i)) {
        var href = document.location.href;
        if (!href.match(/[?&]nowprocket/)) {
            if (href.indexOf("?") == -1) {
                if (href.indexOf("#") == -1) {
                    document.location.href = href + "?nowprocket=1"
                } else {
                    document.location.href = href.replace("#", "?nowprocket=1#")
                }
            } else {
                if (href.indexOf("#") == -1) {
                    document.location.href = href + "&nowprocket=1"
                } else {
                    document.location.href = href.replace("#", "&nowprocket=1#")
                }
            }
        }
    }
</script>
<script>
    class RocketLazyLoadScripts {
        constructor(e) {
            this.triggerEvents = e, this.eventOptions = {
                passive: !0
            }, this.userEventListener = this.triggerListener.bind(this), this.delayedScripts = {
                normal: [],
                async: [],
                defer: []
            }, this.allJQueries = []
        }
        _addUserInteractionListener(e) {
            this.triggerEvents.forEach((t => window.addEventListener(t, e.userEventListener, e.eventOptions)))
        }
        _removeUserInteractionListener(e) {
            this.triggerEvents.forEach((t => window.removeEventListener(t, e.userEventListener, e.eventOptions)))
        }
        triggerListener() {
            this._removeUserInteractionListener(this), "loading" === document.readyState ? document.addEventListener("DOMContentLoaded", this._loadEverythingNow.bind(this)) : this._loadEverythingNow()
        }
        async _loadEverythingNow() {
            this._delayEventListeners(), this._delayJQueryReady(this), this._handleDocumentWrite(), this._registerAllDelayedScripts(), this._preloadAllScripts(), await this._loadScriptsFromList(this.delayedScripts.normal), await this._loadScriptsFromList(this.delayedScripts.defer), await this._loadScriptsFromList(this.delayedScripts.async), await this._triggerDOMContentLoaded(), await this._triggerWindowLoad(), window.dispatchEvent(new Event("rocket-allScriptsLoaded"))
        }
        _registerAllDelayedScripts() {
            document.querySelectorAll("script[type=rocketlazyloadscript]").forEach((e => {
                e.hasAttribute("src") ? e.hasAttribute("async") && !1 !== e.async ? this.delayedScripts.async.push(e) : e.hasAttribute("defer") && !1 !== e.defer || "module" === e.getAttribute("data-rocket-type") ? this.delayedScripts.defer.push(e) : this.delayedScripts.normal.push(e) : this.delayedScripts.normal.push(e)
            }))
        }
        async _transformScript(e) {
            return await this._requestAnimFrame(), new Promise((t => {
                const n = document.createElement("script");
                let r;
                [...e.attributes].forEach((e => {
                    let t = e.nodeName;
                    "type" !== t && ("data-rocket-type" === t && (t = "type", r = e.nodeValue), n.setAttribute(t, e.nodeValue))
                })), e.hasAttribute("src") ? (n.addEventListener("load", t), n.addEventListener("error", t)) : (n.text = e.text, t()), e.parentNode.replaceChild(n, e)
            }))
        }
        async _loadScriptsFromList(e) {
            const t = e.shift();
            return t ? (await this._transformScript(t), this._loadScriptsFromList(e)) : Promise.resolve()
        }
        _preloadAllScripts() {
            var e = document.createDocumentFragment();
            [...this.delayedScripts.normal, ...this.delayedScripts.defer, ...this.delayedScripts.async].forEach((t => {
                const n = t.getAttribute("src");
                if (n) {
                    const t = document.createElement("link");
                    t.href = n, t.rel = "preload", t.as = "script", e.appendChild(t)
                }
            })), document.head.appendChild(e)
        }
        _delayEventListeners() {
            let e = {};

            function t(t, n) {
                ! function(t) {
                    function n(n) {
                        return e[t].eventsToRewrite.indexOf(n) >= 0 ? "rocket-" + n : n
                    }
                    e[t] || (e[t] = {
                        originalFunctions: {
                            add: t.addEventListener,
                            remove: t.removeEventListener
                        },
                        eventsToRewrite: []
                    }, t.addEventListener = function() {
                        arguments[0] = n(arguments[0]), e[t].originalFunctions.add.apply(t, arguments)
                    }, t.removeEventListener = function() {
                        arguments[0] = n(arguments[0]), e[t].originalFunctions.remove.apply(t, arguments)
                    })
                }(t), e[t].eventsToRewrite.push(n)
            }

            function n(e, t) {
                let n = e[t];
                Object.defineProperty(e, t, {
                    get: () => n || function() {},
                    set(r) {
                        e["rocket" + t] = n = r
                    }
                })
            }
            t(document, "DOMContentLoaded"), t(window, "DOMContentLoaded"), t(window, "load"), t(window, "pageshow"), t(document, "readystatechange"), n(document, "onreadystatechange"), n(window, "onload"), n(window, "onpageshow")
        }
        _delayJQueryReady(e) {
            let t = window.jQuery;
            Object.defineProperty(window, "jQuery", {
                get: () => t,
                set(n) {
                    if (n && n.fn && !e.allJQueries.includes(n)) {
                        n.fn.ready = n.fn.init.prototype.ready = function(t) {
                            e.domReadyFired ? t.bind(document)(n) : document.addEventListener("rocket-DOMContentLoaded", (() => t.bind(document)(n)))
                        };
                        const t = n.fn.on;
                        n.fn.on = n.fn.init.prototype.on = function() {
                            if (this[0] === window) {
                                function e(e) {
                                    return e.split(" ").map((e => "load" === e || 0 === e.indexOf("load.") ? "rocket-jquery-load" : e)).join(" ")
                                }
                                "string" == typeof arguments[0] || arguments[0] instanceof String ? arguments[0] = e(arguments[0]) : "object" == typeof arguments[0] && Object.keys(arguments[0]).forEach((t => {
                                    delete Object.assign(arguments[0], {
                                        [e(t)]: arguments[0][t]
                                    })[t]
                                }))
                            }
                            return t.apply(this, arguments), this
                        }, e.allJQueries.push(n)
                    }
                    t = n
                }
            })
        }
        async _triggerDOMContentLoaded() {
            this.domReadyFired = !0, await this._requestAnimFrame(), document.dispatchEvent(new Event("rocket-DOMContentLoaded")), await this._requestAnimFrame(), window.dispatchEvent(new Event("rocket-DOMContentLoaded")), await this._requestAnimFrame(), document.dispatchEvent(new Event("rocket-readystatechange")), await this._requestAnimFrame(), document.rocketonreadystatechange && document.rocketonreadystatechange()
        }
        async _triggerWindowLoad() {
            await this._requestAnimFrame(), window.dispatchEvent(new Event("rocket-load")), await this._requestAnimFrame(), window.rocketonload && window.rocketonload(), await this._requestAnimFrame(), this.allJQueries.forEach((e => e(window).trigger("rocket-jquery-load"))), window.dispatchEvent(new Event("rocket-pageshow")), await this._requestAnimFrame(), window.rocketonpageshow && window.rocketonpageshow()
        }
        _handleDocumentWrite() {
            const e = new Map;
            document.write = document.writeln = function(t) {
                const n = document.currentScript,
                    r = document.createRange(),
                    i = n.parentElement;
                let o = e.get(n);
                void 0 === o && (o = n.nextSibling, e.set(n, o));
                const a = document.createDocumentFragment();
                r.setStart(a, 0), a.appendChild(r.createContextualFragment(t)), i.insertBefore(a, o)
            }
        }
        async _requestAnimFrame() {
            return new Promise((e => requestAnimationFrame(e)))
        }
        static run() {
            const e = new RocketLazyLoadScripts(["keydown", "mousemove", "touchmove", "touchstart", "touchend", "wheel"]);
            e._addUserInteractionListener(e)
        }
    }
    RocketLazyLoadScripts.run();
</script>

<script type="rocketlazyloadscript">(function() {function maybePrefixUrlField() {
	if (this.value.trim() !== '' && this.value.indexOf('http') !== 0) {
		this.value = "http://" + this.value;
	}
}

var urlFields = document.querySelectorAll('.mc4wp-form input[type="url"]');
if (urlFields) {
	for (var j=0; j < urlFields.length; j++) {
		urlFields[j].addEventListener('blur', maybePrefixUrlField);
	}
}
})();</script>
<script type='text/javascript' id='digiqole-script-js-before'>
    var fontList = ["Roboto", "Barlow", "Barlow", "Barlow", "Roboto"]
</script>



<script type='text/javascript' id='elementor-frontend-js-before'>
    var elementorFrontendConfig = {
        "environmentMode": {
            "edit": false,
            "wpPreview": false,
            "isScriptDebug": false
        },
        "i18n": {
            "shareOnFacebook": "Share on Facebook",
            "shareOnTwitter": "Share on Twitter",
            "pinIt": "Pin it",
            "download": "Download",
            "downloadImage": "Download image",
            "fullscreen": "Fullscreen",
            "zoom": "Zoom",
            "share": "Share",
            "playVideo": "Play Video",
            "previous": "Previous",
            "next": "Next",
            "close": "Close"
        },
        "is_rtl": false,
        "breakpoints": {
            "xs": 0,
            "sm": 480,
            "md": 768,
            "lg": 1025,
            "xl": 1440,
            "xxl": 1600
        },
        "responsive": {
            "breakpoints": {
                "mobile": {
                    "label": "Mobile",
                    "value": 767,
                    "default_value": 767,
                    "direction": "max",
                    "is_enabled": true
                },
                "mobile_extra": {
                    "label": "Mobile Extra",
                    "value": 880,
                    "default_value": 880,
                    "direction": "max",
                    "is_enabled": false
                },
                "tablet": {
                    "label": "Tablet",
                    "value": 1024,
                    "default_value": 1024,
                    "direction": "max",
                    "is_enabled": true
                },
                "tablet_extra": {
                    "label": "Tablet Extra",
                    "value": 1200,
                    "default_value": 1200,
                    "direction": "max",
                    "is_enabled": false
                },
                "laptop": {
                    "label": "Laptop",
                    "value": 1366,
                    "default_value": 1366,
                    "direction": "max",
                    "is_enabled": false
                },
                "widescreen": {
                    "label": "Widescreen",
                    "value": 2400,
                    "default_value": 2400,
                    "direction": "min",
                    "is_enabled": false
                }
            }
        },
        "version": "3.4.4",
        "is_static": false,
        "experimentalFeatures": {
            "e_import_export": true,
            "landing-pages": true,
            "elements-color-picker": true,
            "admin-top-bar": true
        },
        "urls": {
            "assets": "https:\/\/demo.themewinter.com\/wp\/digiqole\/wp-content\/plugins\/elementor\/assets\/"
        },
        "settings": {
            "page": [],
            "editorPreferences": []
        },
        "kit": {
            "global_image_lightbox": "yes",
            "active_breakpoints": ["viewport_mobile", "viewport_tablet"],
            "lightbox_enable_counter": "yes",
            "lightbox_enable_fullscreen": "yes",
            "lightbox_enable_zoom": "yes",
            "lightbox_enable_share": "yes",
            "lightbox_title_src": "title",
            "lightbox_description_src": "description"
        },
        "post": {
            "id": 1941,
            "title": "Home%202%20%E2%80%93%20Digiqole",
            "excerpt": "",
            "featuredImage": false
        }
    };
</script>


<script>
    window.lazyLoadOptions = {
        elements_selector: "img[data-lazy-src],.rocket-lazyload,iframe[data-lazy-src]",
        data_src: "lazy-src",
        data_srcset: "lazy-srcset",
        data_sizes: "lazy-sizes",
        class_loading: "lazyloading",
        class_loaded: "lazyloaded",
        threshold: 300,
        callback_loaded: function(element) {
            if (element.tagName === "IFRAME" && element.dataset.rocketLazyload == "fitvidscompatible") {
                if (element.classList.contains("lazyloaded")) {
                    if (typeof window.jQuery != "undefined") {
                        if (jQuery.fn.fitVids) {
                            jQuery(element).parent().fitVids()
                        }
                    }
                }
            }
        }
    };
    window.addEventListener('LazyLoad::Initialized', function(e) {
        var lazyLoadInstance = e.detail.instance;
        if (window.MutationObserver) {
            var observer = new MutationObserver(function(mutations) {
                var image_count = 0;
                var iframe_count = 0;
                var rocketlazy_count = 0;
                mutations.forEach(function(mutation) {
                    for (i = 0; i < mutation.addedNodes.length; i++) {
                        if (typeof mutation.addedNodes[i].getElementsByTagName !== 'function') {
                            continue
                        }
                        if (typeof mutation.addedNodes[i].getElementsByClassName !== 'function') {
                            continue
                        }
                        images = mutation.addedNodes[i].getElementsByTagName('img');
                        is_image = mutation.addedNodes[i].tagName == "IMG";
                        iframes = mutation.addedNodes[i].getElementsByTagName('iframe');
                        is_iframe = mutation.addedNodes[i].tagName == "IFRAME";
                        rocket_lazy = mutation.addedNodes[i].getElementsByClassName('rocket-lazyload');
                        image_count += images.length;
                        iframe_count += iframes.length;
                        rocketlazy_count += rocket_lazy.length;
                        if (is_image) {
                            image_count += 1
                        }
                        if (is_iframe) {
                            iframe_count += 1
                        }
                    }
                });
                if (image_count > 0 || iframe_count > 0 || rocketlazy_count > 0) {
                    lazyLoadInstance.update()
                }
            });
            var b = document.getElementsByTagName("body")[0];
            var config = {
                childList: !0,
                subtree: !0
            };
            observer.observe(b, config)
        }
    }, !1)
</script>


<script>
    function lazyLoadThumb(e) {
        var t = '<img loading="lazy" data-lazy-src="https://i.ytimg.com/vi/ID/hqdefault.jpg" alt="" width="480" height="360"><noscript><img src="https://i.ytimg.com/vi/ID/hqdefault.jpg" alt="" width="480" height="360"></noscript>',
            a = '<div class="play"></div>';
        return t.replace("ID", e) + a
    }

    function lazyLoadYoutubeIframe() {
        var e = document.createElement("iframe"),
            t = "ID?autoplay=1";
        t += 0 === this.dataset.query.length ? '' : '&' + this.dataset.query;
        e.setAttribute("src", t.replace("ID", this.dataset.src)), e.setAttribute("frameborder", "0"), e.setAttribute("allowfullscreen", "1"), e.setAttribute("allow", "accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"), this.parentNode.replaceChild(e, this)
    }
    document.addEventListener("DOMContentLoaded", function() {
        var e, t, a = document.getElementsByClassName("rll-youtube-player");
        for (t = 0; t < a.length; t++) e = document.createElement("div"), e.setAttribute("data-id", a[t].dataset.id), e.setAttribute("data-query", a[t].dataset.query), e.setAttribute("data-src", a[t].dataset.src), e.innerHTML = lazyLoadThumb(a[t].dataset.id), e.onclick = lazyLoadYoutubeIframe, a[t].appendChild(e)
    });
</script>