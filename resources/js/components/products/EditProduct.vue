<template>
    <div>
        <v-card class="w-full">
            <v-card-title>Camiseta de prueba</v-card-title>
            <v-card-text>
                <v-row>
                    <v-col cols="12">
                        <v-text-field filled label="Nombre de Producto"></v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-textarea filled label="Descripción del Producto"></v-textarea>
                    </v-col>
                    <v-col cols="12">
                        <v-subheader><strong>Detalles del Producto</strong></v-subheader>
                        <v-tabs vertical v-model="tab">
                            <v-tab>Inventario</v-tab>
                            <v-tab>Atributos</v-tab>
                            <v-tab>Variaciones</v-tab>
                            <v-tab-item>
                                <div class="px-6 py-4">
                                    <v-text-field filled dense label="SKU"></v-text-field>
                                    <v-text-field filled dense label="Precio base" prefix="US$" value="25"></v-text-field>
                                    <v-text-field filled dense label="Peso" suffix="lbs" value="2"></v-text-field>
                                    <v-subheader>Dimensiones</v-subheader>
                                    <v-row>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field filled dense label="Longitud" suffix="cm" value="1"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field filled dense label="Anchura" suffix="cm" value="8"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field filled dense label="Altura" suffix="cm" value="10"></v-text-field>
                                        </v-col>
                                    </v-row>
                                </div>
                            </v-tab-item>
                            <v-tab-item>
                                <div class="px-6 py-4">
                                    <v-btn tile small color="secondary" @click.prevent="attribute_dialog = true"><v-icon left>mdi-plus</v-icon> Atributo</v-btn>
                                    <v-expansion-panels class="mt-4 mb-4">
                                        <v-expansion-panel>
                                            <v-expansion-panel-header>Color</v-expansion-panel-header>
                                            <v-expansion-panel-content>
                                                <v-row>
                                                    <v-col cols="12" sm="4" md="3">
                                                        <span class="block mb-2">Nombre: <strong>Color</strong></span>
                                                        <v-btn text small color="secondary" @click.prevent="color_dialog = true"><v-icon left>mdi-plus</v-icon> Color</v-btn>
                                                    </v-col>
                                                    <v-col cols="12" sm="8" md="9">
                                                        <v-select filled dense chips v-model="c" :items="colors" :menu-props="{ maxHeight: '400' }" label="Seleccionar colores" multiple hint="Selecciona los colores a utilizar en el producto" persistent-hint></v-select>
                                                    </v-col>
                                                </v-row>
                                            </v-expansion-panel-content>
                                        </v-expansion-panel>
                                        <v-expansion-panel>
                                            <v-expansion-panel-header>Talla</v-expansion-panel-header>
                                            <v-expansion-panel-content>
                                                <v-row>
                                                    <v-col cols="12" sm="4" md="3">
                                                        <span class="block mb-2">Nombre: <strong>Talla</strong></span>
                                                        <v-btn text small color="secondary" @click.prevent="size_dialog = true"><v-icon left>mdi-plus</v-icon> Talla</v-btn>
                                                    </v-col>
                                                    <v-col cols="12" sm="8" md="9">
                                                        <v-select filled dense chips v-model="s" :items="sizes" :menu-props="{ maxHeight: '400' }" label="Seleccionar tallas" multiple hint="Selecciona las tallas a utilizar en el producto" persistent-hint></v-select>
                                                    </v-col>
                                                </v-row>
                                            </v-expansion-panel-content>
                                        </v-expansion-panel>
                                    </v-expansion-panels>
                                </div>
                            </v-tab-item>
                            <v-tab-item>
                                <div class="px-6 py-4">
                                    <v-btn tile small color="secondary" @click.prevent="add_variation"><v-icon left>mdi-plus</v-icon> Variación</v-btn>
                                    <v-expansion-panels class="mt-4 mb-4">
                                        <v-expansion-panel v-for="(item, i) in variation_items" :key="i">
                                            <v-expansion-panel-header>
                                                <template v-slot:default="{ open }">
                                                    <v-row no-gutters>
                                                        <v-col cols="4">
                                                            <v-select class="mr-4" solo outlined dense :items="c" :menu-props="{ maxHeight: '400' }" label="Seleccionar color"></v-select>
                                                        </v-col>
                                                        <v-col cols="4">
                                                            <v-select class="mr-4" solo outlined dense :items="s" :menu-props="{ maxHeight: '400' }" label="Seleccionar talla"></v-select>
                                                        </v-col>
                                                        <v-col cols="4">
                                                            <v-btn fab x-small dark color="error" @click.prevent="remove_variation(i)"><v-icon>mdi-minus</v-icon></v-btn>
                                                        </v-col>
                                                    </v-row>
                                                </template>
                                            </v-expansion-panel-header>
                                            <v-expansion-panel-content>
                                                <div class="px-6 py-4">
                                                    <v-img max-width="100" src="/images/products/product-1.jpg"></v-img>
                                                    <v-file-input chips multiple accept="image/png, image/jpeg" placeholder="Subir imagenes" prepend-icon="mdi-camera" label="Imagenes"></v-file-input>
                                                    <v-text-field filled dense label="SKU"></v-text-field>
                                                    <v-text-field filled dense label="Precio variación" prefix="US$" value="25"></v-text-field>
                                                    <v-text-field filled dense label="Peso" suffix="lbs" value="2"></v-text-field>
                                                    <v-text-field filled dense label="Disponible">5</v-text-field>
                                                    <v-subheader>Dimensiones</v-subheader>
                                                    <v-row>
                                                        <v-col cols="12" sm="6" md="4">
                                                            <v-text-field filled dense label="Longitud" suffix="cm" value="1"></v-text-field>
                                                        </v-col>
                                                        <v-col cols="12" sm="6" md="4">
                                                            <v-text-field filled dense label="Anchura" suffix="cm" value="8"></v-text-field>
                                                        </v-col>
                                                        <v-col cols="12" sm="6" md="4">
                                                            <v-text-field filled dense label="Altura" suffix="cm" value="10"></v-text-field>
                                                        </v-col>
                                                    </v-row>
                                                </div>
                                            </v-expansion-panel-content>
                                        </v-expansion-panel>
                                    </v-expansion-panels>
                                </div>
                            </v-tab-item>
                        </v-tabs>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
        <v-dialog v-model="attribute_dialog" width="500">
            <v-card>
                <v-card-title>Agregar Atributo</v-card-title>
                <v-card-text>
                    <div class="pt-4">
                        <v-text-field filled dense label="Nombre del Atributo"></v-text-field>
                    </div>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" tile @click="attribute_dialog = false">Guardar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-dialog v-model="color_dialog" width="500">
            <v-card>
                <v-card-title>Agregar Color</v-card-title>
                <v-card-text>
                    <div class="pt-4">
                        <v-text-field filled dense label="Color"></v-text-field>
                    </div>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" tile @click="color_dialog = false">Guardar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-dialog v-model="size_dialog" width="500">
            <v-card>
                <v-card-title>Agregar Talla</v-card-title>
                <v-card-text>
                    <div class="pt-4">
                        <v-text-field filled dense label="Talla"></v-text-field>
                    </div>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" tile @click="size_dialog = false">Guardar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>
<script>
export default {
    props: [],
    data() {
        return {
            tab: null,
            attribute_dialog: false,
            color_dialog: false,
            size_dialog: false,
            c: ['Azul', 'Rojo'],
            colors: ['Azul', 'Rojo', 'Verde', 'Negro', 'Blanco'],
            s: ['S', 'M', 'L'],
            sizes: ['XS', 'S', 'M', 'L', 'XL', '2XL'],
            variation_count: 3,
            variation_items: [1, 2],
        };
    },
    mounted() {},
    methods: {
        handle() {},
        add_variation() {
            this.variation_items.push(this.variation_count);
            this.variation_count++;
        },
        remove_variation(i) {
            this.variation_items.splice(i, 1);
        }
    }
}
</script>