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

    initialize: function(wrapperId, defaultVal)
    {
        var self = this;

        // Cache Elements
        this.wrapper = document.id(wrapperId);
        this.selectContainer = this.wrapper.getElement('.tl_customselect_select');
        this.inputContainer = this.wrapper.getElement('.tl_customselect_input');
        this.select = this.selectContainer.getElement('select');
        this.selectOptions = this.selectContainer.getElements('option');
        this.input = this.inputContainer.getElement('input');
        this.reset = this.inputContainer.getElement('.tl_customselect_reset');

        if (this.hasOption(defaultVal)) {
            this.showSelect();
        } else {
            this.showInput();
            this.input.set('value', defaultVal);
        }

        this.select.addEvent('change', function() {
            if (this.options.length === (this.selectedIndex+1)) {
                self.showInput();
            }
        });

        this.reset.addEvent('click', function(e) {
            e.preventDefault();
            self.showSelect();
            // reset select
            self.select.options[0].selected = true;
        });
    },

    // Check if the select has a certain Option.
    hasOption: function(val)
    {
        return this.selectOptions.some(function(item) {
            return item.get('value') === val;
        });
    },

    // show select and dispose textinput
    showSelect: function()
    {
        this.show(this.selectContainer, this.inputContainer);
    },

    // show textinput and dispose select
    showInput: function()
    {
        this.show(this.inputContainer, this.selectContainer);
    },

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
