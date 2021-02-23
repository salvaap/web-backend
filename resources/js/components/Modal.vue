<template>
    <portal to="modals">
        <transition name="fade">
            <div class="__modal" v-if="show">
                <div class="__modal__backdrop" @click="closeModal()"></div>
                <div class="__modal__dialog">
                    <div class="__modal__header">
                        <slot name="header"></slot>
                        <button type="button" class="__modal__close" @click="closeModal()">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    <div class="__modal__body">
                        <slot name="body"></slot>
                    </div>
                    <div class="__modal__footer">
                        <slot name="footer"></slot>
                    </div>
                </div>
            </div>
        </transition>
    </portal>
</template>

<script>
    export default {
        name: 'Modal',
        data() {
            return {
                show: false
            };
        },
        methods: {
            closeModal() {
                this.show = false;
                document.querySelector('body').classList.remove('overflow-hidden');
            },
            openModal() {
                this.show = true;
                document.querySelector('body').classList.add('overflow-hidden');
            }
        }
    };
</script>