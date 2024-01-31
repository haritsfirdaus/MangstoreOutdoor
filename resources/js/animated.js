export default class McdAnimated{
    static animateFromBottomToTop(timeline,selector, startAt = '<0.1', fromProps) {
        timeline.from(
            selector,
            {
                ...fromProps,
                opacity: fromProps && fromProps.opacity ? fromProps.opacity : 0,
                y: fromProps && fromProps.y ? fromProps.y : 10,
            },
            startAt
        );
    }
    
   static animateFromRightToLeft(timeline,selector, startAt = '<0.1', fromProps) {
        timeline.from(
            selector,
            {
                ...fromProps,
                x:fromProps && fromProps.y ? fromProps.y : 10,
            },
            startAt
        );
    }

    static animateFromBlurScale(timeline,selector, startAt = '<0.1', fromProps) {
        timeline.from(
            selector,
            {
                ...fromProps,
                filter: fromProps && fromProps.filter ? fromProps.filter :  'blur(10px)',
                scale: fromProps && fromProps.scale ? fromProps.scale :  1.2
            },
            startAt
        );
    }
}