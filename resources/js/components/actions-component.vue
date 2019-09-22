<template>
    <div class="row">
        <div class="col xs-6">
            <button class="btn btn-info" @click="generateShapesCommand">
                Generate shapes
            </button>
        </div>
        <div class="col xs-6 text-right" @click="changeColorCommand">
            <button class="btn btn-info">
                Change color
            </button>
        </div>
    </div>
</template>

<script>
    import calls from "./calls";

    export default {
        methods: {
            generateShapesCommand() {
                calls.generateShapesCommand()
                    .then(() => window.location.reload())
                    .catch(this.handleException);
            },
            changeColorCommand() {
                calls.changeColorCommand()
                    .then(() => window.location.reload())
                    .catch(this.handleException);
            }
        }
    }
</script>
