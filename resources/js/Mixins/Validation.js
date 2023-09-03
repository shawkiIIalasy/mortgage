export default {
    data() {
        return {
            rules: {
                required: value => !!value || 'This field is required',
                min: (v, min) => parseInt(v) >= min || `This field must not be less than ${min}`,
                max: (v, max) => parseInt(v) < max || `This field must not be greater than ${max}`,
                between: (v, min, max) => {
                    if (v?.length) {
                        return min <= parseInt(v) && parseInt(v) <= max || `This field must be between ${min} and ${max}.`
                    }
                    return true;
                },
            }
        }
    }
}
