
//Mathjax Config

window.MathJax = {
    tex2jax: {
        inlineMath: [ ['$','$'], ["\\(","\\)"] ],
        displayMath: [['$','$'], ["\\(","\\)"] ],
        processEscapes: true,
        skipTags: ["script","noscript","style","textarea","pre","code"],
        ignoreClass: "popover-content"
    }
};

/*
MathJax.Hub.Config({
    extensions: ["tex2jax.js"],
    jax: ["input/TeX", "output/HTML-CSS"],
    tex2jax: {
        inlineMath: [ ['$','$'], ["\\(","\\)"] ],
        displayMath: [ ['$$','$$'], ["\\[","\\]"] ],
        processEscapes: true
    },
    "HTML-CSS": { availableFonts: ["TeX"] }
});*/