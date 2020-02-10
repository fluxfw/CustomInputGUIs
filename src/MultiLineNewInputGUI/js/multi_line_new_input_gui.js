il.MultiLineNewInputGUI = {
    /**
     * @param {number} count
     * @param {jQuery} el
     */
    add: function (count, el) {
        var cloned_el = this.clone_template[count].clone();

        this.init(count, cloned_el);

        el.after(cloned_el);

        this.update(count, el.parent());
    },

    /**
     * @param {number} count
     */
    addFirstLine: function (count) {
        this.add_first_line[count].hide();

        var cloned_el = this.clone_template[count].clone();

        this.init(count, cloned_el);

        this.add_first_line[count].parent().parent().children().eq(1).append(cloned_el);

        this.update(count, this.add_first_line[count].parent().parent().children().eq(1));
    },

    /**
     * @type {object}
     */
    add_first_line: {},

    /**
     * @type {object}
     */
    cached_options: [],

    /**
     * @param {number} count
     * @param {jQuery} el
     * @param {string} type
     * @param {Object} options
     */
    cacheOptions(count, el, type, options) {
        if (!Array.isArray(this.cached_options[count])) {
            this.cached_options[count] = [];
        }

        this.cached_options[count].push({
            type: type,
            options: options
        });

        el.attr("data-cached_options_id", (this.cached_options[count].length - 1));
    },

    /**
     * @type {object}
     */
    clone_template: {},

    /**
     * @param {number} count
     * @param {jQuery} el
     */
    down: function (count, el) {
        el.insertAfter(el.next());

        this.update(count, el.parent());
    },

    /**
     * @param {number} count
     * @param {jQuery} el
     * @param {boolean} add_first_line
     */
    init: function (count, el, add_first_line) {
        $("span[data-action]", el).each(function (i, action_el) {
            action_el = $(action_el);

            action_el.off();

            action_el.on("click", this[action_el.data("action")].bind(this, count, el))
        }.bind(this));

        if (!add_first_line) {
            $(".input-group.date:not([data-cached_options_id])", el).each(function (i2, el2) {
                el2 = $(el2);

                if (el2.data("DateTimePicker")) {
                    this.cacheOptions(count, el2, "datetimepicker", el2.datetimepicker("options"));
                }
            }.bind(this));

            $("select[data-multiselectsearchnewinputgui]:not([data-cached_options_id])", el).each(function (i2, el2) {
                el2 = $(el2);

                const options = JSON.parse(atob(el2.data("multiselectsearchnewinputgui")));

                this.cacheOptions(count, el2, "select2", options);
            }.bind(this));

            if (!this.clone_template[count]) {
                this.clone_template[count] = el.clone();

                $("[name]", this.clone_template[count]).each(function (i2, el2) {
                    if (el2.type === "checkbox") {
                        el2.checked = false;
                    } else {
                        el2.value = "";
                    }
                });

                $(".alert", this.clone_template[count]).remove();

                this.clone_template[count].show();

                $("select[data-multiselectsearchnewinputgui]", this.clone_template[count]).each(function (i2, el2) {
                    el2 = $(el2);

                    el2.html("");
                }.bind(this));

                if (el.parent().parent().data("remove_first_line")) {
                    this.remove(count, el);
                }
            }
        } else {
            this.add_first_line[count] = el;
        }
    },

    /**
     * @param {number} count
     * @param {jQuery} el
     */
    remove: function (count, el) {
        var parent = el.parent();

        if (!parent.parent().data("required") || parent.children().length > 1) {
            el.remove();

            this.update(count, parent);
        }
    },

    /**
     * @param {number} count
     * @param {jQuery} el
     */
    up: function (count, el) {
        el.insertBefore(el.prev());

        this.update(count, el.parent());
    },

    /**
     * @param {number} count
     * @param {jQuery} el
     */
    update: function (count, el) {
        $("span[data-action=up]", el).show();
        $("> div:first-of-type span[data-action=up]", el).hide();

        $("span[data-action=down]", el).show();
        $("> div:last-of-type span[data-action=down]", el).hide();

        for (const key of ["aria-controls", "aria-labelledby", "href", "id", "name"]) {
            el.children().each(function (i, el) {
                $("[" + key + "]", el).each(function (i2, el2) {
                    for (const [char_open, char_close] of [["[", "]["], ["__", "__"]]) {
                        el2.attributes[key].value = el2.attributes[key].value.replace(new RegExp(char_open.replace(/./g, "\\$&") + "[0-9]+" + char_close.replace(/./g, "\\$&")), char_open + i + char_close);
                    }
                }.bind(this));
            }.bind(this));
        }

        if (el.parent().data("required")) {
            if (el.children().length < 2) {
                $("span[data-action=remove]", el).hide();
            } else {
                $("span[data-action=remove]", el).show();
            }
        } else {
            $("span[data-action=remove]", el).show();

            if (el.children().length === 0) {
                this.add_first_line[count].show();
            }
        }

        $("[data-cached_options_id]", el).each(function (i2, el2) {
            el2 = $(el2);

            const options = this.cached_options[count][el2.attr("data-cached_options_id")];
            if (!options) {
                return;
            }
            switch (options.type) {
                case "datetimepicker":
                    if (el2.data("DateTimePicker")) {
                        el2.datetimepicker("destroy");
                    }

                    el2.prop("id", "");

                    el2.datetimepicker(options.options);
                    break;

                case "select2":
                    if (el2.data("select2")) {
                        el2.select2("destroy");
                    }

                    el2.next(".select2").remove();

                    el2.removeAttr("class");
                    el2.removeAttr("data-select2-id");
                    el2.removeAttr("aria-hidden");
                    el2.removeAttr("tabindex");

                    el2.select2(options.options);
                    break;

                default:
                    break;
            }
        }.bind(this));
    }
};
