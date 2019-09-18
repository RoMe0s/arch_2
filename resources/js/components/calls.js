export default {
    getShapes: () => axios.get('/api/shapes'),
    getActions: () => axios.get('/api/actions'),
    undoActionCommand: actionId => axios.post(`/api/command/${actionId}/undo`),
    generateShapesCommand: () => axios.post('/api/command/generate-shapes'),
    changeColorCommand: () => axios.post('/api/command/change-color'),
    undoActionsCommand: limit => axios.post('/api/command/undo', {limit})
};
