document.addEventListener("DOMContentLoaded", function () {
    let radios = document.getElementsByName("radio");
    let general = document.getElementById("general");
    let account = document.getElementById("account");
    let name = document.getElementById("name");
    let company = document.getElementById("company");
    let giro = document.getElementById("giro");
    let address = document.getElementById("address");
    let department = document.getElementById("department");
    let municipality = document.getElementById("municipality");
    let phone = document.getElementById("phone");
    let phone_call = document.getElementById("phone_call");
    let phone_whatsapp = document.getElementById("phone_whatsapp");
    let iva = document.getElementById("iva");
    let dui = document.getElementById("dui");
    let nit = document.getElementById("nit");
    let email = document.getElementById("email");
    let password = document.getElementById("password");
    let password_confirm = document.getElementById("password-confirm");

    function show(id) {
        document.getElementById(id).style.display = "block";
    }

    function hide(id) {
        document.getElementById(id).style.display = "none";
    }

    // Show/Hide inputs if radio button is selected by default
    function selectedRadio() {
        let radioValue = document.querySelector(
            'input[name="radio"]:checked'
        ).value;

        if (radioValue === "nocontribuyente") {
            //Show
            show("general");
            show("account");
            show("name");
            show("address");
            show("department");
            show("municipality");
            show("nit");
            show("dui");
            show("phone");
            show("phone_call");
            show("phone_whatsapp");
            show("email");
            show("password");
            show("password-confirm");

            //Hide
            hide("company");
            hide("giro");
            hide("iva");
        } else if (radioValue === "contribuyente") {
            //Show
            show("general");
            show("account");
            show("company");
            show("giro");
            show("address");
            show("department");
            show("municipality");
            show("nit");
            show("iva");
            show("phone");
            show("phone_call");
            show("phone_whatsapp");
            show("email");
            show("password");
            show("password-confirm");

            //Hide
            hide("name");
            hide("dui");
        }
    }

    // Show/Hide inputs if radio button change value
    for (let i = 0; i < radios.length; i++) {
        radios[i].addEventListener("change", function () {
            let radioValue = this.value;

            if (radioValue === "nocontribuyente") {
                //Show
                show("general");
                show("account");
                show("name");
                show("address");
                show("department");
                show("municipality");
                show("nit");
                show("dui");
                show("phone");
                show("phone_call");
                show("phone_whatsapp");
                show("email");
                show("password");
                show("password-confirm");

                //Hide
                hide("company");
                hide("giro");
                hide("iva");
            } else if (radioValue === "contribuyente") {
                //Show
                show("general");
                show("account");
                show("company");
                show("giro");
                show("address");
                show("department");
                show("municipality");
                show("nit");
                show("iva");
                show("phone");
                show("phone_call");
                show("phone_whatsapp");
                show("email");
                show("password");
                show("password-confirm");

                //Hide
                hide("name");
                hide("dui");
            }
        });
    }

    selectedRadio();
});
