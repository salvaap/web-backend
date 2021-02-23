<template>
    <form class="block w-full" @submit.prevent="handle" @keydown="form.errors.clear()" novalidate>
        <div class="w-full px-2">
            <v-row>
                <v-col cols="12" md="4">
                    <v-card>
                        <v-card-text>
                            <v-row>
                                <v-col cols="12">
                                    <v-img class="mx-auto mb-4" v-if="form.featured_image" max-width="350" :src="form.featured_image"></v-img>
                                    <upload-featured-image v-if="!form.featured_image" @selected="set_featured_image"></upload-featured-image>
                                    <div class="text-center">
                                        <v-btn v-if="form.featured_image" tile small color="error" @click.prevent="clear_featured_image"><v-icon left small>mdi-close</v-icon> Quitar Imagen Principal</v-btn>
                                    </div>
                                </v-col>
                                <v-col cols="12">
                                    <v-switch v-model="form.is_promoted" label="¿Promocionar producto?"></v-switch>
                                </v-col>
                                <v-col cols="12">
                                    <v-switch v-model="form.in_offer" label="¿El producto está en oferta?"></v-switch>
                                </v-col>
                                <v-col v-if="form.in_offer" cols="12">
                                    <v-text-field filled dense label="Porcentaje de descuento" suffix="%" v-model.number="form.offer_discount" :error-messages="form.errors.get('offer_discount')"></v-text-field>
                                </v-col>
                                <v-col cols="12">
                                    <v-autocomplete @change="category_change" filled :items="categories" :menu-props="{ maxHeight: '400' }" item-value="id" :item-text="display_category_option" v-model.number="form.category_id" :error-messages="form.errors.get('category_id')" label="Seleccionar categoria" hint="Selecciona la categoria del producto" persistent-hint></v-autocomplete>
                                </v-col>
                                <v-col cols="12">
                                    <v-autocomplete filled :items="conditions" :menu-props="{ maxHeight: '400' }" item-value="id" :item-text="display_condition_option" v-model.number="form.condition_id" :error-messages="form.errors.get('condition_id')" label="Seleccionar condición del producto" hint="Selecciona la condición del producto" persistent-hint></v-autocomplete>
                                </v-col>
                                <v-col cols="12">
                                    <v-text-field filled label="Días para preparación" v-model.number="form.preparation_days" :error-messages="form.errors.get('preparation_days')" hint="En caso que el producto necesite un tiempo para ser preparado/ensamblado, antes de ser enviado, definir los días necesarios" persistent-hint></v-text-field>
                                </v-col>
                            </v-row>
                        </v-card-text>
                    </v-card>
                </v-col>
                <v-col cols="12" md="8">
                    <v-card>
                        <v-card-text>
                            <v-row>
                                <v-col cols="12">
                                    <v-text-field filled label="Nombre de Producto" v-model="form.name" :error-messages="form.errors.get('name')" required></v-text-field>
                                </v-col>
                                <v-col cols="12">
                                    <vue-editor class="mb-6 editor" placeholder="Descripción del Producto" :editor-toolbar="toolbar" v-model="form.description" />
                                </v-col>
                                <v-col cols="12">
                                    <v-select filled :items="weight_ranges" item-value="id" :item-text="display_weight_range_option" v-model.number="form.weight_range_id" :error-messages="form.errors.get('weight_range_id')" label="Seleccionar rango de peso" hint="Selecciona el rango de precio del producto." persistent-hint></v-select>
                                </v-col>
                                <v-col cols="12">
                                    <v-subheader>Dimensiones</v-subheader>
                                    <v-row>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field filled dense label="Longitud" suffix="pulgadas" v-model.number="form.length" :error-messages="form.errors.get('length')"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field filled dense label="Anchura" suffix="pulgadas" v-model.number="form.width" :error-messages="form.errors.get('width')"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field filled dense label="Altura" suffix="pulgadas" v-model.number="form.height" :error-messages="form.errors.get('height')"></v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-col>
                                <v-col cols="12">
                                    <v-switch v-model="form.is_variant" label="¿Es un producto variante?" hint="Un producto variante es ideal para definir ropa con cantidades diferentes por talla y/o color (entre otros posibles atributos)." persistent-hint></v-switch>
                                </v-col>
                                <v-col cols="12" v-if="!form.is_variant">
                                    <v-subheader><strong>Detalles del Producto</strong></v-subheader>
                                    <v-row>
                                        <v-col cols="12">
                                            <v-text-field filled dense label="SKU" v-model="form.sku" :error-messages="form.errors.get(`sku`)"></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field filled dense label="Precio" prefix="C$" v-model.number="form.price" :error-messages="form.errors.get(`price`)"></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field filled dense label="Cantidad" suffix="unidades" v-model.number="form.amount" :error-messages="form.errors.get(`amount`)"></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-row v-if="form.images.length > 0">
                                                <v-col v-for="(image, i) in form.images" :key="i" class="d-flex child-flex" cols="2">
                                                    <v-img class="text-right pa-1 b-1" aspect-ratio="1" :src="image" :lazy-src="'/images/placeholder.jpg'">
                                                        <template v-slot:placeholder>
                                                            <v-row class="fill-height ma-0" align="center" justify="center"><v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular></v-row>
                                                        </template>
                                                        <v-btn icon dark @click="remove_image(i)">
                                                            <v-icon color="error">mdi-delete</v-icon>
                                                        </v-btn>
                                                    </v-img>
                                                </v-col>
                                            </v-row>
                                            <upload-product-images @selected="set_product_images"></upload-product-images>
                                        </v-col>
                                    </v-row>
                                </v-col>
                                <v-col cols="12" v-else>
                                    <v-subheader><strong>Detalles del Producto</strong></v-subheader>
                                    <v-col cols="12">
                                        <v-switch v-model="form.copy_properties" label="¿Utilizar valores de peso y dimensiones en todas las variantes?"></v-switch>
                                    </v-col>
                                    <v-tabs vertical v-model="tab">
                                        <v-tab>Atributos</v-tab>
                                        <v-tab>Variaciones</v-tab>
                                        <v-tab-item>
                                            <div class="px-6 py-4">
                                                <v-row>
                                                    <v-col cols="12">
                                                        <v-subheader><strong>Selecciona los atributos que se utilizarán con el producto.</strong></v-subheader>
                                                        <v-autocomplete filled multiple small-chips v-model="form.attributes" :return-object="true" :items="attributes" item-text="name" item-value="id" label="Seleccionar atributos" autcomplete="false" @change="attribute_change" :error-messages="form.errors.get('attributes')"></v-autocomplete>
                                                    </v-col>
                                                    <v-col cols="12" v-if="form.attributes < 1">
                                                        <i class="block">No se han seleccionado atributos</i>
                                                    </v-col>
                                                    <v-col cols="12" v-else>
                                                        <v-subheader><strong>Específica los valores disponibles para el producto por atributo.</strong></v-subheader>
                                                        <v-expansion-panels class="mt-4 mb-4">
                                                            <v-expansion-panel v-for="(attribute, index) in form.attributes" :key="index">
                                                                <v-expansion-panel-header>{{attribute.name}}</v-expansion-panel-header>
                                                                <v-expansion-panel-content>
                                                                    <v-row>
                                                                        <v-col cols="12" sm="4" md="3">
                                                                            <span class="block mb-2">Nombre: <strong>{{attribute.name}}</strong></span>
                                                                        </v-col>
                                                                        <v-col cols="12" sm="8" md="9">
                                                                            <v-select filled dense multiple small-chips v-model="attribute.selected_values" :return-object="true" :items="attribute.available_values" :menu-props="{ maxHeight: '400' }" item-text="name" item-value="id" label="Seleccionar valores" hint="Selecciona los valores a utilizar en el producto" persistent-hint autcomplete="false" :error-messages="form.errors.get(`attributes.${index}.selected_values`)"></v-select>
                                                                        </v-col>
                                                                    </v-row>
                                                                </v-expansion-panel-content>
                                                            </v-expansion-panel>
                                                        </v-expansion-panels>
                                                    </v-col>
                                                </v-row>
                                            </div>
                                        </v-tab-item>
                                        <v-tab-item>
                                            <div class="px-6 py-4">
                                                <v-row>
                                                    <v-col cols="12">
                                                        <v-btn :disabled="form.attributes.length < 1" class="mb-4" text small color="secondary" @click.prevent="add_variation" type="button"><v-icon left>mdi-plus</v-icon> Variación</v-btn>
                                                        <v-alert dense outlined type="error" v-if="form.errors.has(`variants`) && form.variants.length < 1" v-text="form.errors.get(`variants`)"></v-alert><!-- attributes.*.selected_values -->
                                                    </v-col>
                                                    <v-col cols="12" v-if="form.variants < 1">
                                                        <i class="block">No se han registrado variaciones, debes especificar al menos una variación.</i>
                                                    </v-col>
                                                    <v-col cols="12" v-else>
                                                        <v-subheader><strong>Específica los detalles para las variaciones del producto.</strong></v-subheader>
                                                        <v-expansion-panels class="mt-4 mb-4">
                                                            <v-expansion-panel v-for="(variant, index) in form.variants" :key="index">
                                                                <v-expansion-panel-header>
                                                                    <template v-slot:default="{ open }">
                                                                        <v-row no-gutters>
                                                                            <v-col cols="12">
                                                                                <span class="inline-block mr-5">Variación&nbsp;&nbsp;{{index + 1}}</span>
                                                                                <v-btn fab x-small dark color="error" @click.prevent="remove_variant(index)" type="button"><v-icon>mdi-minus</v-icon></v-btn>
                                                                            </v-col>
                                                                        </v-row>
                                                                    </template>
                                                                </v-expansion-panel-header>
                                                                <v-expansion-panel-content>
                                                                    <div class="px-6 py-4">
                                                                        <v-row no-gutters>
                                                                            <v-col cols="3" v-for="(attribute, i) in form.attributes" :key="i">
                                                                                <v-select class="mr-2" solo outlined dense :return-object="true" v-model="variant.values[i]" :items="attribute.selected_values" item-text="name" item-value="id" :menu-props="{ maxHeight: '400' }" label="Seleccionar valor"></v-select>
                                                                            </v-col>
                                                                        </v-row>
                                                                        <v-row>
                                                                            <v-col cols="12">
                                                                                <v-img class="mx-auto mb-4" v-if="variant.featured_image" max-width="250" :src="variant.featured_image"></v-img>
                                                                                <upload-featured-image v-if="!variant.featured_image" :index="index" @selected="set_variant_featured_image"></upload-featured-image>
                                                                                <div class="text-center">
                                                                                    <v-btn v-if="variant.featured_image" tile small color="error" @click.prevent="clear_variant_featured_image(index)"><v-icon left small>mdi-close</v-icon> Quitar Imagen Principal</v-btn>
                                                                                </div>
                                                                            </v-col>
                                                                            <v-col cols="12">
                                                                                <v-text-field filled dense label="SKU" v-model="variant.sku" :error-messages="form.errors.get(`variants.${index}.sku`)"></v-text-field>
                                                                            </v-col>
                                                                            <v-col cols="12">
                                                                                <v-text-field filled dense label="Precio" prefix="C$" v-model.number="variant.price" :error-messages="form.errors.get(`variants.${index}.price`)"></v-text-field>
                                                                            </v-col>
                                                                            <v-col cols="12">
                                                                                <v-text-field filled dense label="Cantidad" suffix="unidades" v-model.number="variant.amount" :error-messages="form.errors.get(`variants.${index}.amount`)"></v-text-field>
                                                                            </v-col>
                                                                            <v-col cols="12">
                                                                                <v-select filled :items="weight_ranges" item-value="id" :item-text="display_weight_range_option" v-model.number="variant.weight_range_id" :error-messages="form.errors.get('weight_range_id')" label="Seleccionar rango de peso" hint="Selecciona el rango de precio del producto." persistent-hint></v-select>
                                                                            </v-col>
                                                                            <v-col cols="12">
                                                                                <v-subheader>Dimensiones</v-subheader>
                                                                                <v-row>
                                                                                    <v-col cols="12" sm="6" md="4">
                                                                                        <v-text-field filled dense label="Longitud" suffix="pulgadas" v-model.number="variant.length" :error-messages="form.errors.get(`variants.${index}.length`)"></v-text-field>
                                                                                    </v-col>
                                                                                    <v-col cols="12" sm="6" md="4">
                                                                                        <v-text-field filled dense label="Anchura" suffix="pulgadas" v-model.number="variant.width" :error-messages="form.errors.get(`variants.${index}.width`)"></v-text-field>
                                                                                    </v-col>
                                                                                    <v-col cols="12" sm="6" md="4">
                                                                                        <v-text-field filled dense label="Altura" suffix="pulgadas" v-model.number="variant.height" :error-messages="form.errors.get(`variants.${index}.height`)"></v-text-field>
                                                                                    </v-col>
                                                                                </v-row>
                                                                            </v-col>
                                                                            <v-col cols="12">
                                                                                <v-row v-if="variant.images.length > 0">
                                                                                    <v-col v-for="(image, i) in variant.images" :key="i" class="d-flex child-flex" cols="2">
                                                                                        <v-img class="text-right pa-1 b-1" aspect-ratio="1" :src="image" :lazy-src="'/images/placeholder.jpg'">
                                                                                            <template v-slot:placeholder>
                                                                                                <v-row class="fill-height ma-0" align="center" justify="center"><v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular></v-row>
                                                                                            </template>
                                                                                            <v-btn icon dark @click="remove_variant_image(index, i)">
                                                                                                <v-icon color="error">mdi-delete</v-icon>
                                                                                            </v-btn>
                                                                                        </v-img>
                                                                                    </v-col>
                                                                                </v-row>
                                                                                <upload-product-images :index="index" @selected="set_variant_images"></upload-product-images>
                                                                            </v-col>
                                                                        </v-row>
                                                                    </div>
                                                                </v-expansion-panel-content>
                                                            </v-expansion-panel>
                                                        </v-expansion-panels>
                                                    </v-col>
                                                </v-row>
                                            </div>
                                        </v-tab-item>
                                    </v-tabs>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="12" class="pt-4">
                                    <v-btn tile :loading="saving" :disabled="saving" color="primary" type="submit">Guardar</v-btn>
                                </v-col>
                            </v-row>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>
        </div>
        <v-snackbar color="green" v-model="is_completed" :timeout="1800">Producto guardado correctamente.</v-snackbar>
        <v-snackbar color="red" v-model="has_errors" :timeout="1800">Hay errores, revise detenidamente la información proporcionada.</v-snackbar>
        <v-dialog v-model="promote_dialog" width="500">
            <v-card>
                <v-card-title>Promocionar producto</v-card-title>
                <v-card-text>
                    <p>Al promocionar un producto pagas un monto mensual de C$20.00</p>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn text tile @click="form.is_promoted = false; promote_dialog = false;" type="button">Cancelar</v-btn>
                    <v-btn color="primary" tile @click="promote_dialog = false" type="button">Aceptar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-dialog v-model="weight_dialog" width="500">
            <v-card>
                <v-card-title>Envio</v-card-title>
                <v-card-text>
                    <p>Productos mayores a 30 KG no aplican para envios con los proveedores registrados.</p>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" tile @click="weight_dialog = false" type="button">Aceptar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-dialog v-model="uploading" hide-overlay persistent width="300">
            <v-card color="primary" dark>
                <v-card-text>
                    Cargando...
                    <v-progress-linear indeterminate color="white" class="mb-0"></v-progress-linear>
                </v-card-text>
            </v-card>
        </v-dialog>
    </form>
</template>
<script>
import ProductService from '../../services/products';
import AttributeService from '../../services/attributes';

export default {
    props: ['categories', 'attributes', 'conditions', 'weight_ranges'],
    props: {
        product_id: {
            type: Number,
            default: 0,
        },
        categories: {
            type: Array,
            default: []
        },
        conditions: {
            type: Array,
            default: []
        },
        weight_ranges: {
            type: Array,
            default: []
        }
    },
    data() {
        return {
            loading_attributes: false,
            attributes: [],
            selected_attributes: [],
            tab: null,
            saving: false,
            uploading: false,
            is_completed: false,
            has_errors: false,
            saving: false,
            promote_dialog: false,
            weight_dialog: false,
            toolbar: [
                ["bold", "italic"],
                [{ list: "ordered" }, { list: "bullet" }],
            ],
            form: new Form({
                id: null,
                name: null,
                description: null,
                featured_image: null,
                is_variant: false,
                in_offer: false,
                offer_discount: null,
                amount: null,
                preparation_days: null,
                category_id: null,
                condition_id: null,
                weight_range_id: null,
                length: null,
                width: null,
                height: null,
                sku: null,
                price: null,
                is_promoted: false,
                copy_properties: false,
                images: [],
                variants: [],
                attributes: [],
            }),
            ps: new ProductService(),
            as: new AttributeService(),
        };
    },
    watch: {
        /*selected_attributes(val, prev) {
            console.log(val)
        }*/
        'form.is_promoted': function(val) {
            if(val) {
                this.promote_dialog = true;
            }
        },
        'form.weight_range_id': function(val) {
            if(val == 7) {
                this.weight_dialog = true;
            }
        }
    },
    mounted() {
        //console.log(this.categories);
        //this.available_attributes = this.attributes;
    },
    methods: {
        set_product_images(items) {
            this.form.images = _.union(this.form.images, items);
        },
        set_variant_images(items, index) {
            this.form.variants[index].images = _.union(this.form.variants[index].images, items);
        },
        value_created(value, index) {
            this.selected_attributes[index].available_values.push(value);
            this.form.attributes = _.cloneDeep(this.selected_attributes);
        },
        attribute_created(attribute) {
            this.available_attributes.push(attribute);
        },
        variant_images_change(files, index) {
            if(files.length < 1) {
                return;
            }
            var data = new FormData();
            _.forEach(files, (image) => {
                data.append('images[]', image);
            });
            this.uploading = true;
            axios.post(`/products/images`, data, {headers: {'Content-Type': 'multipart/form-data'}}).then(response => {
                this.form.variants[index].images = response.data.images;
            }).catch(e => {
                console.log(e);
            }).finally(() => {
                this.uploading = false;
            });
        },
        attribute_change() {
            if(this.form.attributes.length === 0) {
                this.form.attributes = [];
                return;
            }
            _.forEach(this.form.attributes, (attribute, key) => {
                this.get_att_values(attribute);
            });
        },
        /*attribute_value_change() {
            this.form.attributes = _.cloneDeep(this.selected_attributes);
        },*/
        add_variation() {
            if(this.form.copy_properties) {
                this.form.variants.push({
                    sku: null,
                    featured_image: null,
                    price: null,
                    amount: null,
                    length: this.form.length,
                    width: this.form.width,
                    height: this.form.height,
                    weight_range_id: this.form.weight_range_id,
                    values: [],
                    images: []
                });
            } else {
                this.form.variants.push({
                    sku: null,
                    featured_image: null,
                    price: null,
                    amount: null,
                    length: null,
                    width: null,
                    height: null,
                    weight_range_id: null,
                    values: [],
                    images: []
                });
            }
        },
        get_att_values(attribute) {
            this.as.searchValues(attribute.id).then(data => {
                Vue.set(attribute, 'available_values', data)
                //attribute.available_values = data;
                //attribute.active = true;
                //this.selected_attributes = _.cloneDeep(this.form.attributes);
            }).catch(e => {
                console.log(e);
            });
            /*if(!attribute.active) {
                this.as.searchValues(attribute.id).then(data => {
                    attribute.available_values = data;
                    attribute.active = true;
                    //this.selected_attributes = _.cloneDeep(this.form.attributes);
                }).catch(e => {
                    console.log(e);
                });
            } else {
                //this.selected_attributes = _.cloneDeep(this.form.attributes);
            }*/
        },
        display_category_option(value) {
            return `${value.name} (${value.parent.name})`;
        },
        display_condition_option(value) {
            return `${value.name}`;
        },
        display_weight_range_option(value) {
            return `${value.range}`;
        },
        remove_image(i) {
            this.form.images.splice(i, 1);
        },
        remove_variant_image(index, i) {
            this.form.variants[index].images.splice(i, 1);
        },
        remove_variant(i) {
            this.form.variants.splice(i, 1);
        },
        upload_progress(e) {
            this.progress = (e.loaded * 100) / e.total;
        },
        set_featured_image(image) {
            this.form.featured_image = image;
        },
        set_variant_featured_image(image, index) {
            this.form.variants[index].featured_image = image;
        },
        clear_featured_image() {
            this.form.featured_image = '';
        },
        clear_variant_featured_image(index) {
            this.form.variants[index].featured_image = '';
        },
        category_change() {
            if(this.form.category_id) {
                this.as.selectAttributes({'category_id': this.form.category_id}).then(data => {
                    this.attributes = data;
                }).catch(e => {
                    console.log(e);
                });
            } else {
                this.attributes = [];
            }
        },
        handle() {
            this.saving = true;
            this.form.post(`/dashboard/products`)
                .then(data => {
                    this.is_completed = true;
                    setTimeout(() => {
                        window.location.replace('/dashboard/products')
                    }, 2000);
                })
                .catch(e => {
                    this.has_errors = true;
                })
                .finally(() => {
                    this.saving = false;
                });
        }
    }
}
</script>