<template>
    <div class="container mt-3 mb-3">
        <actions-component></actions-component>
        <hr>
        <shapes-component></shapes-component>
        <hr>
        <history-component></history-component>
        <hr>
        <undo-component></undo-component>
    </div>
</template>

<script>
    import ActionsComponent from './actions-component';
    import ShapesComponent from './shapes-component';
    import HistoryComponent from './history-component';
    import UndoComponent from './undo-component';

    export default {
        components: {
            ActionsComponent,
            ShapesComponent,
            HistoryComponent,
            UndoComponent
        }
    }
</script>
