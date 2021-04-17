(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["js/upload-product-images"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/products/UploadProductImages.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/products/UploadProductImages.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _services_products__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../services/products */ "./resources/js/services/products.js");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['index'],
  data: function data() {
    return {
      gallery_modal: false,
      loading: true,
      uploading: false,
      upload_error: '',
      items: [],
      selected_items: [],
      progress: 0,
      ps: new _services_products__WEBPACK_IMPORTED_MODULE_0__["default"]()
    };
  },
  mounted: function mounted() {},
  methods: {
    init: function init() {
      this.gallery_modal = true;
      this.getImages();
    },
    close: function close() {
      this.selected_items = [];
      this.gallery_modal = false;
    },
    select: function select() {
      if (this.index !== undefined) {
        this.$emit('selected', this.selected_items, this.index);
      } else {
        this.$emit('selected', this.selected_items);
      }

      this.selected_items = [];
      this.gallery_modal = false;
    },
    images_change: function images_change(files) {
      var _this = this;

      if (files.length < 1) {
        return;
      }

      var formdata = new FormData();

      _.forEach(files, function (image) {
        formdata.append('images[]', image);
      });

      this.uploading = true;
      this.upload_error = '';
      this.ps.uploadImages(formdata, {
        headers: {
          'Content-Type': 'multipart/form-data'
        },
        onUploadProgress: this.upload_progress
      }).then(function (data) {
        _this.items = _.unionBy(data.images, _this.items, 'id');
      })["catch"](function (e) {
        _this.upload_error = e.errors.image ? e.errors.image[0] : 'Una o más imagenes no tienen las dimensiones correctas: mínimo de 800px, máximo de 1000px (imagen cuadrada)'; //console.log(e);
      })["finally"](function () {
        _this.uploading = false;
      });
    },
    upload_progress: function upload_progress(e) {
      this.progress = e.loaded * 100 / e.total;
    },
    getImages: function getImages() {
      var _this2 = this;

      this.ps.getImages().then(function (data) {
        _this2.items = data.items;
      })["catch"](function (e) {//console.log(e)
      })["finally"](function () {
        _this2.loading = false;
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/products/UploadProductImages.vue?vue&type=template&id=4add7274&":
/*!*******************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/products/UploadProductImages.vue?vue&type=template&id=4add7274& ***!
  \*******************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c(
        "v-btn",
        {
          attrs: { color: "accent", tile: "", small: "" },
          on: {
            click: function($event) {
              $event.preventDefault()
              return _vm.init($event)
            }
          }
        },
        [
          _c("v-icon", { attrs: { left: "", small: "" } }, [
            _vm._v("mdi-image")
          ]),
          _vm._v("Seleccionar imágenes")
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "v-dialog",
        {
          attrs: { persistent: "", scrollable: "" },
          model: {
            value: _vm.gallery_modal,
            callback: function($$v) {
              _vm.gallery_modal = $$v
            },
            expression: "gallery_modal"
          }
        },
        [
          _c(
            "v-card",
            [
              _c(
                "v-card-title",
                [
                  _c("h3", [_vm._v("Galería de Imágenes de Producto")]),
                  _c("v-spacer"),
                  _c(
                    "v-btn",
                    {
                      attrs: { icon: "" },
                      on: {
                        click: function($event) {
                          $event.preventDefault()
                          return _vm.close($event)
                        }
                      }
                    },
                    [_c("v-icon", [_vm._v("mdi-close")])],
                    1
                  )
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "v-card-text",
                { staticStyle: { height: "80vh" } },
                [
                  _c(
                    "v-row",
                    [
                      _c(
                        "v-col",
                        { attrs: { cols: "12" } },
                        [
                          _vm.uploading
                            ? _c("v-progress-linear", {
                                attrs: { value: _vm.progress }
                              })
                            : _vm._e(),
                          _vm._v(" "),
                          _c("v-file-input", {
                            attrs: {
                              dense: "",
                              filled: "",
                              chips: "",
                              multiple: "",
                              accept: "image/png, image/jpeg, image/jpg",
                              placeholder: "Subir imágenes",
                              "prepend-icon": "mdi-image",
                              label: "Subir imagenes",
                              hint:
                                "Las imagenes deben tener dimensiones mínimas de 800px y máximas de 1000px; debe ser una imagen cuadrada",
                              "persistent-hint": "",
                              "error-messages": _vm.upload_error
                            },
                            on: { change: _vm.images_change }
                          })
                        ],
                        1
                      )
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "v-row",
                    [
                      _vm.loading
                        ? _c("v-col", { attrs: { cols: "12" } }, [
                            _c(
                              "div",
                              { staticClass: "text-center" },
                              [
                                _c("v-progress-circular", {
                                  attrs: {
                                    size: 50,
                                    color: "primary",
                                    indeterminate: ""
                                  }
                                })
                              ],
                              1
                            )
                          ])
                        : _c(
                            "v-col",
                            { attrs: { cols: "12" } },
                            [
                              _vm.items.length
                                ? _c(
                                    "v-item-group",
                                    {
                                      attrs: { multiple: "" },
                                      model: {
                                        value: _vm.selected_items,
                                        callback: function($$v) {
                                          _vm.selected_items = $$v
                                        },
                                        expression: "selected_items"
                                      }
                                    },
                                    [
                                      _c(
                                        "v-row",
                                        _vm._l(_vm.items, function(item) {
                                          return _c(
                                            "v-col",
                                            {
                                              key: item.id,
                                              attrs: {
                                                cols: "6",
                                                sm: "3",
                                                lg: "2",
                                                xl: "1"
                                              }
                                            },
                                            [
                                              _c("v-item", {
                                                attrs: { value: item.url },
                                                scopedSlots: _vm._u(
                                                  [
                                                    {
                                                      key: "default",
                                                      fn: function(ref) {
                                                        var active = ref.active
                                                        var toggle = ref.toggle
                                                        return [
                                                          _c(
                                                            "v-card",
                                                            {
                                                              attrs: {
                                                                outlined: "",
                                                                tile: ""
                                                              }
                                                            },
                                                            [
                                                              _c(
                                                                "v-img",
                                                                {
                                                                  staticClass:
                                                                    "text-right pa-1 b-1",
                                                                  attrs: {
                                                                    src:
                                                                      item.url,
                                                                    "lazy-src":
                                                                      "/images/placeholder.jpg",
                                                                    "aspect-ratio":
                                                                      "1"
                                                                  },
                                                                  on: {
                                                                    click: toggle
                                                                  },
                                                                  scopedSlots: _vm._u(
                                                                    [
                                                                      {
                                                                        key:
                                                                          "placeholder",
                                                                        fn: function() {
                                                                          return [
                                                                            _c(
                                                                              "v-row",
                                                                              {
                                                                                staticClass:
                                                                                  "fill-height ma-0",
                                                                                attrs: {
                                                                                  align:
                                                                                    "center",
                                                                                  justify:
                                                                                    "center"
                                                                                }
                                                                              },
                                                                              [
                                                                                _c(
                                                                                  "v-progress-circular",
                                                                                  {
                                                                                    attrs: {
                                                                                      indeterminate:
                                                                                        "",
                                                                                      color:
                                                                                        "grey lighten-5"
                                                                                    }
                                                                                  }
                                                                                )
                                                                              ],
                                                                              1
                                                                            )
                                                                          ]
                                                                        },
                                                                        proxy: true
                                                                      }
                                                                    ],
                                                                    null,
                                                                    true
                                                                  )
                                                                },
                                                                [
                                                                  _vm._v(" "),
                                                                  _c(
                                                                    "v-btn",
                                                                    {
                                                                      attrs: {
                                                                        icon:
                                                                          "",
                                                                        dark: ""
                                                                      }
                                                                    },
                                                                    [
                                                                      _c(
                                                                        "v-icon",
                                                                        {
                                                                          attrs: {
                                                                            color:
                                                                              "blue"
                                                                          }
                                                                        },
                                                                        [
                                                                          _vm._v(
                                                                            _vm._s(
                                                                              active
                                                                                ? "mdi-checkbox-marked"
                                                                                : "mdi-checkbox-blank-outline"
                                                                            )
                                                                          )
                                                                        ]
                                                                      )
                                                                    ],
                                                                    1
                                                                  )
                                                                ],
                                                                1
                                                              )
                                                            ],
                                                            1
                                                          )
                                                        ]
                                                      }
                                                    }
                                                  ],
                                                  null,
                                                  true
                                                )
                                              })
                                            ],
                                            1
                                          )
                                        }),
                                        1
                                      )
                                    ],
                                    1
                                  )
                                : _c("div", [
                                    _c("p", { staticClass: "text-center" }, [
                                      _vm._v(
                                        "No hay imágenes en la galería de productos."
                                      )
                                    ])
                                  ])
                            ],
                            1
                          )
                    ],
                    1
                  )
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "v-card-actions",
                [
                  _c("v-spacer"),
                  _vm._v(" "),
                  _c(
                    "v-btn",
                    {
                      attrs: {
                        tile: "",
                        small: "",
                        color: "primary",
                        type: "button",
                        disabled: _vm.uploading || _vm.selected_items.length < 1
                      },
                      on: {
                        click: function($event) {
                          $event.preventDefault()
                          return _vm.select($event)
                        }
                      }
                    },
                    [_vm._v("Seleccionar")]
                  )
                ],
                1
              )
            ],
            1
          )
        ],
        1
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/products/UploadProductImages.vue":
/*!******************************************************************!*\
  !*** ./resources/js/components/products/UploadProductImages.vue ***!
  \******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _UploadProductImages_vue_vue_type_template_id_4add7274___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./UploadProductImages.vue?vue&type=template&id=4add7274& */ "./resources/js/components/products/UploadProductImages.vue?vue&type=template&id=4add7274&");
/* harmony import */ var _UploadProductImages_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./UploadProductImages.vue?vue&type=script&lang=js& */ "./resources/js/components/products/UploadProductImages.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _UploadProductImages_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _UploadProductImages_vue_vue_type_template_id_4add7274___WEBPACK_IMPORTED_MODULE_0__["render"],
  _UploadProductImages_vue_vue_type_template_id_4add7274___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/products/UploadProductImages.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/products/UploadProductImages.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************!*\
  !*** ./resources/js/components/products/UploadProductImages.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_UploadProductImages_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./UploadProductImages.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/products/UploadProductImages.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_UploadProductImages_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/products/UploadProductImages.vue?vue&type=template&id=4add7274&":
/*!*************************************************************************************************!*\
  !*** ./resources/js/components/products/UploadProductImages.vue?vue&type=template&id=4add7274& ***!
  \*************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_UploadProductImages_vue_vue_type_template_id_4add7274___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./UploadProductImages.vue?vue&type=template&id=4add7274& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/products/UploadProductImages.vue?vue&type=template&id=4add7274&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_UploadProductImages_vue_vue_type_template_id_4add7274___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_UploadProductImages_vue_vue_type_template_id_4add7274___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);