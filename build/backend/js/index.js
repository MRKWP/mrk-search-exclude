(() => {
    "use strict";
    var e = {
            n: (t) => {
                var o = t && t.__esModule ? () => t.default : () => t;
                return e.d(o, { a: o }), o;
            },
            d: (t, o) => {
                for (var n in o) e.o(o, n) && !e.o(t, n) && Object.defineProperty(t, n, { enumerable: !0, get: o[n] });
            },
            o: (e, t) => Object.prototype.hasOwnProperty.call(e, t),
            r: (e) => {
                "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, { value: "Module" }), Object.defineProperty(e, "__esModule", { value: !0 });
            },
        },
        t = {};
    e.r(t);
    const o = window.jQuery;
    !(function (e) {
        const t = inlineEditPost.edit;
        inlineEditPost.edit = function (o) {
            t.apply(this, arguments);
            let n = 0;
            if (("object" == typeof o && (n = parseInt(this.getId(o))), n > 0)) {
                const t = e("#edit-" + n),
                    o = e("#search-exclude-" + n).data("search_exclude");
                t.find('input[name="sep[exclude]"]').prop("checked", o);
            }
        };
    })(e.n(o)()),
        ((window.tiktok = window.tiktok || {}).backend = t);
})();
