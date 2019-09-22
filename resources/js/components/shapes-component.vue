<template>
    <div>
        <h2>Generated shapes</h2>
        <ul>
            <li v-for="shape in shapes">
                {{ shape.type }}
                {{ shape.color }}
            </li>
        </ul>
        <p v-if="!shapes.length">
            Empty
        </p>
    </div>
</template>

<script>
    import calls from "./calls";

    export default {
        data() {
            return {
                shapes: []
            }
        },
        created() {
            calls.getShapes()
                .then(response => this.shapes = response.data)
                .catch(this.handleException);
        }
    }
</script>
