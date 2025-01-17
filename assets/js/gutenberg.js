const edt_icon = wp.element.createElement(
  "svg",
  {
    "aria-hidden": "true",
    role: "img",
    focusable: "false",
    viewBox: "0 0 24 24",
    width: 24,
    height: 24,
  },
  wp.element.createElement("path", {
    d:
      "M4.57 4.634 L2.775 5.668 C2.424 5.87 2.303 6.32 2.505 6.671 L3.539 8.466 C3.636 8.634 3.815 8.738 4.009 8.738 4.104 8.738 4.197 8.713 4.279 8.665 4.538 8.516 4.627 8.185 4.478 7.925 L3.618 6.433 5.111 5.573 C5.37 5.423 5.459 5.092 5.31 4.833 5.161 4.574 4.829 4.484 4.57 4.634 Z M23.814 10.122 L19.846 2.923 C19.498 2.292 18.701 2.061 18.069 2.409 L12.184 5.653 9.564 1.106 C9.204 0.481 8.403 0.265 7.778 0.625 L0.656 4.728 C0.353 4.903 0.136 5.184 0.045 5.522 -0.046 5.856 0.001 6.214 0.175 6.514 L4.278 13.637 C4.52 14.057 4.96 14.291 5.413 14.291 5.635 14.291 5.859 14.235 6.064 14.117 L6.633 13.789 4.543 16.882 C4.348 17.169 4.275 17.522 4.342 17.863 4.409 18.206 4.604 18.502 4.894 18.698 L11.704 23.301 C11.92 23.447 12.175 23.525 12.436 23.525 12.87 23.526 13.277 23.31 13.52 22.95 L18.123 16.139 C18.417 15.705 18.413 15.155 18.159 14.732 L23.3 11.898 C23.931 11.55 24.162 10.754 23.814 10.122 Z M5.523 13.178 C5.416 13.24 5.279 13.203 5.217 13.096 L1.114 5.973 C1.052 5.866 1.089 5.729 1.196 5.667 L8.319 1.564 C8.426 1.503 8.563 1.539 8.625 1.646 L11.234 6.176 10.871 6.377 C10.565 6.545 10.343 6.823 10.246 7.159 10.148 7.492 10.188 7.85 10.357 8.153 L11.294 9.854 11.221 9.896 10.961 9.721 C10.745 9.574 10.49 9.496 10.23 9.496 9.795 9.496 9.389 9.712 9.146 10.072 L8.017 11.741 Z M17.225 15.533 L12.622 22.343 C12.58 22.405 12.51 22.442 12.436 22.442 12.391 22.442 12.349 22.429 12.311 22.403 L5.5 17.8 C5.451 17.767 5.417 17.715 5.406 17.657 5.395 17.599 5.407 17.538 5.44 17.489 L10.043 10.678 C10.085 10.617 10.155 10.58 10.23 10.58 10.275 10.58 10.317 10.593 10.354 10.618 L17.165 15.221 C17.267 15.291 17.294 15.43 17.225 15.533 Z M22.777 10.949 L17.27 13.985 13.346 11.333 11.305 7.63 C11.277 7.578 11.27 7.517 11.286 7.46 11.303 7.403 11.341 7.354 11.393 7.326 L18.592 3.358 C18.701 3.298 18.837 3.338 18.897 3.446 L22.865 10.645 C22.924 10.753 22.885 10.89 22.777 10.949 Z M18.866 5.024 C18.671 4.67 18.223 4.54 17.868 4.736 L16.054 5.736 C15.792 5.88 15.697 6.21 15.841 6.472 15.985 6.734 16.315 6.829 16.577 6.685 L18.086 5.853 18.917 7.362 C18.987 7.488 19.103 7.581 19.241 7.621 19.379 7.661 19.527 7.644 19.653 7.575 19.915 7.43 20.011 7.101 19.866 6.839 Z M9.38 18.08 L7.953 17.115 8.917 15.688 C9.085 15.44 9.02 15.103 8.772 14.936 8.524 14.768 8.187 14.833 8.02 15.081 L6.859 16.797 C6.633 17.133 6.721 17.591 7.057 17.818 L8.773 18.978 C8.892 19.058 9.038 19.088 9.179 19.061 9.321 19.033 9.445 18.951 9.525 18.832 9.693 18.584 9.628 18.247 9.38 18.08 Z",
  })
);

wp.blocks.registerBlockType("simple-data-tables/simple-data-tables-block", {
  title: "Simple Data Tables",
  icon: edt_icon,
  description:
    "Quickly and easily create and embed interactive data tables with your posts, pages, comments, users, or attachments.",
  category: "widgets",
  attributes: {
    type: { type: "string", default: "" },
    filter: { type: "string", default: "" },
    display: { type: "array", default: [] },
    output: { type: "string", default: "" },
  },
  edit: function (props) {
    var type = props.attributes.type,
      filter = props.attributes.filter,
      display = props.attributes.display,
      output = props.attributes.output;
    // global var used to preload selected columns
    wp.data.select("core/editor").display = display;
    function updateType(event) {
      props.setAttributes({ type: event.target.value });
    }
    function updateFilter(event) {
      props.setAttributes({ filter: event.target.value });
    }
    function updateDisplay(event) {
      if (event.target.checked === true) {
        display.push(event.target.value);
      } else {
        // remove arr el
        display.splice(display.indexOf(event.target.value), true);
      }
      // keep arr unique
      var new_display = display.filter((v, i, a) => a.indexOf(v) === i);
      props.setAttributes({ display: new_display });
    }
    function updateReturn(event) {
      props.setAttributes({ output: event.target.value });
    }
    return wp.element.createElement(
      "div",
      {
        id: "simple-data-tables",
        className: "simple-data-tables simple-data-tables-" + type,
      },
      wp.element.createElement(
        // fragment > hidden heading
        wp.element.Fragment,
        null,
        wp.element.createElement(
          "label",
          {
            className: "edt-heading",
          },
          "[/] Simple Data Table"
        )
      ),
      wp.element.createElement("textarea", {
        id: "edt-shortcode",
        className: "edt-shortcode",
        value:
          '[simple-data-table type="' +
          type +
          '" filter="' +
          filter +
          '" display="' +
          display.join(",") +
          '" output="' +
          output +
          '"]',
        readonly: true,
        rows: 2,
      }),
      wp.element.createElement(
        // fragment > custom controls > shortcode settings
        wp.element.Fragment,
        null,
        wp.element.createElement(
          wp.blockEditor.InspectorControls,
          null,
          wp.element.createElement(
            "label",
            {
              className: "edt-label",
            },
            "Type"
          ),
          wp.element.createElement(
            "select",
            {
              className: "edt-options",
              onChange: updateType,
              value: type,
            },
            wp.element.createElement("option", { value: "" }, "select one"),
            wp.element.createElement("option", { value: "post" }, "Post"),
            wp.element.createElement("option", { value: "page" }, "Page"),
            wp.element.createElement("option", { value: "comment" }, "Comment"),
            wp.element.createElement("option", { value: "attachment" }, "Attachment"),
            wp.element.createElement("option", { value: "user" }, "User")
          ),
          wp.element.createElement(
            "label",
            {
              className: "edt-label",
            },
            "Filter"
          ),
          wp.element.createElement(
            "select",
            {
              className: "edt-options",
              onChange: updateFilter,
              value: filter,
            },
            wp.element.createElement("option", { value: "" }, "select one"),
            wp.element.createElement("option", { value: "author" }, "Author / Role")
            // TODO @version 1.2
            // wp.element.createElement( 'option', { value: 'category' }, 'Category' ),
            // wp.element.createElement( 'option', { value: 'tag' }, 'Tag' ),
            // wp.element.createElement( 'option', { value: 'post' }, 'Post' ),
            // wp.element.createElement( 'option', { value: 'role' }, 'Role' ),
          ),
          wp.element.createElement(
            "label",
            {
              className: "edt-label",
            },
            "Output"
          ),
          wp.element.createElement(
            "select",
            {
              className: "edt-options",
              onChange: updateReturn,
              value: output,
            },
            wp.element.createElement("option", { value: "" }, "select one"),
            wp.element.createElement("option", { value: "html" }, "HTML")
            // TODO @version 1.2
            // wp.element.createElement( 'option', { value: 'raw' }, 'Raw' ),
            // wp.element.createElement( 'option', { value: 'json' }, 'JSON' ),
          ),
          wp.element.createElement(
            "label",
            {
              className: "edt-label",
            },
            "Columns "
          ),
          wp.element.createElement(
            "div",
            {
              className: "edt-checkbox-group",
            },
            wp.element.createElement(
              "div",
              {
                className: "edt-checkbox",
              },
              wp.element.createElement("input", {
                id: "display-id",
                type: "checkbox",
                value: "id",
                onClick: updateDisplay,
              }),
              wp.element.createElement(
                "label",
                {
                  htmlFor: "display-id",
                },
                "ID"
              )
            ),
            wp.element.createElement(
              "div",
              {
                className: "edt-checkbox",
              },
              wp.element.createElement("input", {
                id: "display-author",
                type: "checkbox",
                value: "author",
                onClick: updateDisplay,
              }),
              wp.element.createElement(
                "label",
                {
                  htmlFor: "display-author",
                },
                "Author / Role"
              )
            ),
            wp.element.createElement(
              "div",
              {
                className: "edt-checkbox",
              },
              wp.element.createElement("input", {
                id: "display-date",
                type: "checkbox",
                value: "date",
                onClick: updateDisplay,
              }),
              wp.element.createElement(
                "label",
                {
                  htmlFor: "display-date",
                },
                "Date"
              )
            ),
            wp.element.createElement(
              "div",
              {
                className: "edt-checkbox",
              },
              wp.element.createElement("input", {
                id: "display-title",
                type: "checkbox",
                value: "title",
                onClick: updateDisplay,
              }),
              wp.element.createElement(
                "label",
                {
                  htmlFor: "display-title",
                },
                "Title"
              )
            ),
            wp.element.createElement(
              "div",
              {
                className: "edt-checkbox",
              },
              wp.element.createElement("input", {
                id: "display-status",
                type: "checkbox",
                value: "status",
                onClick: updateDisplay,
              }),
              wp.element.createElement(
                "label",
                {
                  htmlFor: "display-status",
                },
                "Status"
              )
            ),
            wp.element.createElement(
              "div",
              {
                className: "edt-checkbox",
              },
              wp.element.createElement("input", {
                id: "display-link",
                type: "checkbox",
                value: "link",
                onClick: updateDisplay,
              }),
              wp.element.createElement(
                "label",
                {
                  htmlFor: "display-link",
                },
                "Link"
              )
            )
          )
        )
      )
    );
  },
  save: function (props) {
    var type = props.attributes.type,
      filter = props.attributes.filter,
      display = props.attributes.display,
      output = props.attributes.output;
    return wp.element.createElement(
      "div",
      {
        id: "simple-data-tables",
        className: "simple-data-tables simple-data-tables-" + type,
      },
      wp.element.RawHTML({
        children:
          '[simple-data-table type="' +
          type +
          '" filter="' +
          filter +
          '" display="' +
          display.join(",") +
          '" output="' +
          output +
          '"]',
      })
    );
  },
});

document.addEventListener(
  "click",
  function (event) {
    var targetElement = event.target || event.srcElement;
    if (
      targetElement.getAttribute("class") === "editor-block-list__layout" ||
      targetElement.getAttribute("class") === "edt-label" ||
      targetElement.getAttribute("id") === "edt-shortcode"
    ) {
      if (typeof wp.data.select("core/editor").display === "object") {
        wp.data.select("core/editor").display.forEach(function (item, index) {
          document.getElementById("display-" + item).setAttribute("checked", true);
        });
      }
    }
  },
  true
);
