class CommonAction {

    constructor(mainObject){
        if(this.constructor === CommonAction){
            throw new Error("Can't instantiate CommonAction class!");
        }
        this.mainObject = mainObject
    }

    action = () => {
        console.log('method action must be implemented in child class')
    }
}

export default CommonAction