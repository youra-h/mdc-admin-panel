const Spinner = (function () {
    let _instance;
    let _blockWindow;
    let _spinner;

    function Spinner() {
        if (_instance) {
            return _instance;
        }
        _instance = this;
        _blockWindow = document.getElementById('block-window');
        _spinner = app.controls.item('app-spinner');
    }

    Spinner.prototype.open = function () {
        _blockWindow.style.display = 'block';
        _spinner.open();
    }

    /**
     * @param {string} reason Closes the snackbar_, optionally with the specified reason indicating why it was closed. 
     */
    Spinner.prototype.close = function () {
        _blockWindow.style.display = 'none';
        _spinner.close();
    }

    return Spinner;
})();

// export { Spinner };