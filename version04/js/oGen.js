var oGen = {

    /**
     * Valida si el mail es correcto
     * @param {String} c 
     */
    isEmail: function (c) {
        return c.match(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i) !== null;
    },
    /**
     * Valida si el número de teléfono es válido
     * @param {String} c 
     */
    isPhone: function (c) {
        return /^([0-9]{3,5})+(-){0,1}([0-9]{6,8})$/i.test(c);
    }
}