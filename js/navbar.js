function nativation(id, route) {
    localStorage.setItem('currentPage', route);
    $(id).load(route);
}

const isPathInValid = path => {
    return !(path != null && path != '' && path != undefined && path != 'null' && path != 'undefined');
}