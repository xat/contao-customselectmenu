module.exports = function(grunt) {
    grunt.initConfig({
        min: {
            min: {
                src: ['js/customselectmenu.js'],
                dest: 'js/customselectmenu.min.js'
            }
        },
        lint: {
            files: ['js/customselectmenu.js']
        }
    });

    grunt.registerTask('default', 'min lint');
};
