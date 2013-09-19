// Set up prototypal inheritance - if it doesn't exist
if (typeof Object.create !== 'function') {
    Object.create = function (o) {
        function F() {}
        F.prototype = o;
        return new F();
    };
}

Z = {};

// @todo move these in their appropriate files
Z.Enrollment = {};
Z.Components = {};
Z.User = {};
