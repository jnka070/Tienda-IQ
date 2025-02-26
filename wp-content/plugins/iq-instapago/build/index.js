(() => {
    "use strict";
    const e = window.React,
        t = window.wp.htmlEntities,
        { registerPaymentMethod: n } = window.wc.wcBlocksRegistry,
        { getSetting: a } = window.wc.wcSettings,
        i = a("iq-instapago_gateway_data", {}),
        s = (0, t.decodeEntities)(i.title),
        c = () => (0, t.decodeEntities)(i.description || "");
    n({
        name: "iq-instapago",
        label: (0, e.createElement)((t) => {
            const { PaymentMethodLabel: n } = t.components;
            return (0, e.createElement)(n, { text: s });
        }, null),
        content: (0, e.createElement)(c, null),
        edit: (0, e.createElement)(c, null),
        canMakePayment: () => !0,
        ariaLabel: s,
        supports: { features: i.supports },
    });
})();
