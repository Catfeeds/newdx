var N = {};
(function($){
    N = $.extend(N, {
        namespace: function(){
            var a = arguments, o = null, i, j, d;
            for (i = 0; i < a.length; i++) {
                d = a[i].split('.');
                o = N;
                for (j = (d[0] == 'N') ? 1 : 0; j < d.length; j++) {
                    o[d[j]] = o[d[j]] || {};
                    o = o[d[j]];
                }
            }
            return o;
        }
    });
})(jQuery);
N.namespace('countDown');
(function(){
    /**
     * 倒计时，参数形式：
     * {
     *  startTime       //开始时间
     *  endTime         //结束时间
     *  callback        //每次回调
     * }
     * 单位：毫秒
     * @param {Object} options
     */
    N.countDown = function(options){
        if (options.startTime == null)
            throw "args:startTime is null";
        if (options.endTime == null)
            throw "args:endTime is null";
        this.startTime = options.startTime.constructor == Date ? options.startTime.getTime() : options.startTime;
        this.endTime = options.endTime.constructor == Date ? options.endTime.getTime() : options.endTime;
        this.callback = options.callback || new Function();
        this.startCount();
    };
    N.countDown.prototype = {
        startCount: function(){
            var startTime = this.startTime;
            var endTime = this.endTime;
            var fn = this.callback;
            var that = this;
            var sign = setInterval(function(){
                startTime += 1000;
                if (startTime > endTime) {
                    //window.location.reload();
                    clearInterval(sign);
                }
                else {
                    var remain = (endTime - startTime) / 1000;
                    var day = parseInt(remain / 3600 / 24);
                    var hour = parseInt((remain - day * 24 * 3600) / 3600);
                    var minute = parseInt((remain - day * 24 * 3600 - hour * 3600) / 60);
                    var second = parseInt(remain - day * 24 * 3600 - hour * 3600 - minute * 60);
                    fn(day, hour, minute, second);
                    if(startTime+1000>endTime){
                        window.location.reload();
                    }

                }
            }, 1000);
        }
    };
})();