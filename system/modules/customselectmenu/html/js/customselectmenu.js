/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * @package   CustomSelectMenu
 * @author    Simon Kusterer
 * @license   LGPL
 * @copyright Simon Kusterer 2012
 */

var CustomSelectMenu = new Class({

    /**
     * Initialize the CustomSelectMenu
     *
     * @param String wrapperId
     * @param String defaultVal
     */
    initialize: function(wrapperId, defaultVal)
    {
        // It's JS.. we need this strange stuff :)
        var self = this;

        // Cache Elements
        this.wrapper         = document.id(wrapperId); // Wrapper-Div.. everything is in here
        this.selectContainer = this.wrapper.getElement('.tl_customselect_select');
        this.inputContainer  = this.wrapper.getElement('.tl_customselect_input');
        this.select          = this.selectContainer.getElement('select'); // The actual select-Element
        this.selectOptions   = this.selectContainer.getElements('option'); // Array of Option-Elements
        this.input           = this.inputContainer.getElement('input'); // Textinput
        this.reset           = this.inputContainer.getElement('.tl_customselect_reset'); // 'x'-Button

        if (this.hasOption(defaultVal)) {
            // there is an option which has
            // defaultVal as value.. so let's show
            // the Select
            this.showSelect();
        } else {
            // There is no Option which contains
            // the default Value. Let's switch to the textinput
            // and set the value
            this.showInput();
            this.input.set('value', defaultVal);
        }

        this.select.addEvent('change', function() {
            if (this.options.length === (this.selectedIndex+1)) {
                // last option of the select was choosen
                // switch to the textinput
                self.showInput();
            }
        });

        // someone clicked the 'x' besides the textinput
        // switch back to the Select
        this.reset.addEvent('click', function(e) {
            e.preventDefault();
            self.showSelect();
            // reset select
            self.select.options[0].selected = true;
        });
    },

    /**
     * Check if the select has a certain Option.
     *
     * @param String val
     */
    hasOption: function(val)
    {
        return this.selectOptions.some(function(item) {
            return item.get('value') === val;
        });
    },

    /**
     * Show select and dispose textinput
     */
    showSelect: function()
    {
        this.show(this.selectContainer, this.inputContainer);
    },

    /**
     * Show textinput and dispose select
     */
    showInput: function()
    {
        this.show(this.inputContainer, this.selectContainer);
        this.input.focus();
    },

    /**
     * Show one and hide the other :)
     *
     * @param Element showEl
     * @param Element hideEl
     */
    show: function(showEl, hideEl)
    {
        if (hideEl.getParent()) {
            hideEl = hideEl.dispose();
        }

        if (!showEl.getParent()) {
            showEl.inject(this.wrapper);
        }
    }

});
