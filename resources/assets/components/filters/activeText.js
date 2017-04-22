function activeText(value) {
    if (!value) {
        return '未開放查詢'
    }
    return '已開放';
}

export default activeText;