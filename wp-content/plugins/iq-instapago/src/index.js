import { decodeEntities } from "@wordpress/html-entities";

const { registerPaymentMethod } = window.wc.wcBlocksRegistry;
const { getSetting } = window.wc.wcSettings;

const settings = getSetting("iq_instapago_gateway_data", {});

const label = decodeEntities(settings.title);

const Content = () => {
    return decodeEntities(settings.description || "");
};

const Label = (props) => {
    const { PaymentMethodLabel } = props.components;
    return <PaymentMethodLabel text={label} />;
};

registerPaymentMethod({
    name: "iq-instapago",
    label: <Label />,
    content: <Content />,
    edit: <Content />,
    canMakePayment: () => true,
    ariaLabel: label,
    supports: {
        features: settings.supports,
    },
});
