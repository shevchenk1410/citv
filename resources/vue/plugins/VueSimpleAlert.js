import Swal from "sweetalert2/dist/sweetalert2";

const VueSimpleAlert = {
    globalOptions: {},

    alert(message, title, icon, options) {
        return new Promise((resolve) => {
            const mixedOptions = {
                ...VueSimpleAlert.globalOptions,
                ...options,
                title: title || options?.title,
                text: message || options?.message,
                icon: icon || options?.icon,
            };
            Swal.fire(mixedOptions)
                .then(() => {
                    resolve(true);
                })
                .catch(() => {
                    resolve(true);
                });
        });
    },

    confirm(message, title, icon, options) {
        return new Promise((resolve, reject) => {
            const mixedOptions = {
                ...VueSimpleAlert.globalOptions,
                ...options,
                title: title || options?.title,
                text: message || options?.message,
                icon: icon || options?.icon,
                showCancelButton: true,
            };
            Swal.fire(mixedOptions)
                .then((result) => {
                    if (result.isConfirmed) {
                        resolve(true);
                    } else {
                        reject();
                    }
                })
                .catch(() => {
                    reject();
                });
        });
    },

    prompt(message, defaultText, title, icon, options) {
        return new Promise((resolve, reject) => {
            const mixedOptions = {
                ...VueSimpleAlert.globalOptions,
                ...options,
                title: title || options?.title,
                inputValue: defaultText,
                text: message || options?.message,
                icon: icon || options?.icon,
                showCancelButton: true,
                input: options?.input || "text",
            };
            Swal.fire(mixedOptions)
                .then((result) => {
                    if (result.value) {
                        resolve(result.value);
                    } else {
                        reject();
                    }
                })
                .catch(() => {
                    reject();
                });
        });
    },

    fire(options) {
        return Swal.fire(options);
    },

    install(app, options) {
        VueSimpleAlert.globalOptions = options;

        // Agregando métodos globales
        app.config.globalProperties.$alert = VueSimpleAlert.alert;
        app.config.globalProperties.$confirm = VueSimpleAlert.confirm;
        app.config.globalProperties.$prompt = VueSimpleAlert.prompt;
        app.config.globalProperties.$fire = VueSimpleAlert.fire;
    }
};

export { VueSimpleAlert };
export default VueSimpleAlert;
