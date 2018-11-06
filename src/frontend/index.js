import {
    createElement,
    Component,
    PropTypes,
    LocaleProvider,
    Translate,
    SwitchesPanel,
    SwitchesPanelItem,
    Button,
    Popover,
    List,
    Status,
    Drawer,
    Toolbar,
    ToolbarGroup,
    ToolbarExpander,
    Switch,
} from '@plesk/plesk-ext-sdk';
import axios from 'axios';

export default class extends Component {
    static propTypes = {
        baseUrl: PropTypes.string.isRequired,
    };

    state = {
        optionA: null,
        optionB: null,
        optionC: null,
        optionD: null,
        optionE: null,
        optionF: null,
        isSwitchOptionBProcessing: null,
        entities: null,
        selectionE: [],
        selectionF: [],
        isDrawerEOpen: false,
        isDrawerFOpen: false,
    };

    switchOptionA() {
        const { baseUrl } = this.props;
        axios.get(`${baseUrl}/api/toggle-option-a`)
            .then(({ data }) => this.setState({ optionA: data }));
    }

    switchOptionB() {
        this.setState({ isSwitchOptionBProcessing: true} );
        const { baseUrl } = this.props;
        axios.get(`${baseUrl}/api/toggle-option-b`)
            .then(() => {
                this.pollOptionB();
            });
    }

    switchOptionC() {
        const { baseUrl } = this.props;
        axios.get(`${baseUrl}/api/toggle-option-c`)
            .then(({ data }) => this.setState({ optionC: data }));
    }

    switchOptionD() {
        const { baseUrl } = this.props;
        axios.get(`${baseUrl}/api/toggle-option-d`)
            .then(({ data }) => this.setState({ optionD: data }));
    }

    switchOptionE() {
        const { baseUrl } = this.props;
        axios.get(`${baseUrl}/api/toggle-option-e`)
            .then(({ data }) => this.setState({ optionE: data }));
    }

    switchOptionF() {
        const { baseUrl } = this.props;
        axios.get(`${baseUrl}/api/toggle-option-f`)
            .then(({ data }) => this.setState({ optionF: data }));
    }

    pollOptionB() {
        const { baseUrl } = this.props;
        axios.get(`${baseUrl}/api/is-option-b-scheduled`).then(({ data }) => {
            if (false === data) {
                axios.get(`${baseUrl}/api/get-option-b`)
                    .then(({ data }) => this.setState({ optionB: data }))
                    .finally(() => this.setState({ isSwitchOptionBProcessing: false }));
            } else {
                setTimeout(() => {
                    this.pollOptionB()
                }, 1000);
            }
        });
    }

    turnOnEntityOptionE() {
        const { baseUrl } = this.props;
        axios.post(`${baseUrl}/api/toggle-entity-option-e`, {
            selection: this.state.selectionE,
            action: "activate",
        }).then(({ data }) => this.setState({ entities: data }));
    }
    turnOffEntityOptionE() {
        const { baseUrl } = this.props;
        axios.post(`${baseUrl}/api/toggle-entity-option-e`, {
            selection: this.state.selectionE,
            action: "deactivate",
        }).then(({ data }) => this.setState({ entities: data }));
    }

    turnOnEntityOptionF() {
        const { baseUrl } = this.props;
        axios.post(`${baseUrl}/api/toggle-entity-option-f`, {
            selection: this.state.selectionF,
            action: "activate",
        }).then(({ data }) => this.setState({ entities: data }));
    }
    turnOffEntityOptionF() {
        const { baseUrl } = this.props;
        axios.post(`${baseUrl}/api/toggle-entity-option-f`, {
            selection: this.state.selectionF,
            action: "deactivate",
        }).then(({ data }) => this.setState({ entities: data }));
    }

    componentDidMount() {
        console.log(this.props);
        const { baseUrl } = this.props;
        axios.get(`${baseUrl}/api/get-option-a`).then(({ data }) => this.setState({ optionA: data }));
        axios.get(`${baseUrl}/api/get-option-b`).then(({ data }) => this.setState({ optionB: data }));
        axios.get(`${baseUrl}/api/get-option-c`).then(({ data }) => this.setState({ optionC: data }));
        axios.get(`${baseUrl}/api/get-option-d`).then(({ data }) => this.setState({ optionD: data }));
        axios.get(`${baseUrl}/api/get-option-e`).then(({ data }) => this.setState({ optionE: data }));
        axios.get(`${baseUrl}/api/get-option-f`).then(({ data }) => this.setState({ optionF: data }));
        axios.get(`${baseUrl}/api/is-option-b-scheduled`).then(({ data }) => this.setState({ isSwitchOptionBProcessing: data }));
        axios.get(`${baseUrl}/api/get-entities`).then(({ data }) => this.setState({ entities: data }));
    }

    render() {
        if (
            null == this.state.optionA ||
            null == this.state.optionB ||
            null == this.state.optionC ||
            null == this.state.optionD ||
            null == this.state.isSwitchOptionBProcessing ||
            null == this.state.entities ||
            null == this.state.optionE ||
            null == this.state.optionF
        ) {
            return null;
        }

        if (this.state.isSwitchOptionBProcessing) {
            this.pollOptionB();
        }

        const listColumnsE = [
            {
                key: 'name',
                title: <Translate content="entity.column.title.name"/>,
                width: '75%',
            }, {
                key: 'optionE',
                title: <Translate content="entity.column.title.optionE"/>,
            }
        ];
        const listColumnsF = [
            {
                key: 'name',
                title: <Translate content="entity.column.title.name"/>,
                width: '75%',
            }, {
                key: 'optionF',
                title: <Translate content="entity.column.title.optionF"/>,
            }
        ];

        const listDataE = this.state.entities.map(entity => {
            return {
                key: entity.id,
                name: entity.name,
                optionE: entity.optionE ?
                    <Status intent="success"><Translate content="entity.column.value.on"/></Status> :
                    <Status intent="danger"><Translate content="entity.column.value.off"/></Status>,
            };
        });
        const listDataF = this.state.entities.map(entity => {
            return {
                key: entity.id,
                name: entity.name,
                optionF: entity.optionF ?
                    <Status intent="success"><Translate content="entity.column.value.on"/></Status> :
                    <Status intent="danger"><Translate content="entity.column.value.off"/></Status>,
            };
        });

        return (
            <div>
                <SwitchesPanel title={<Translate content="section.general"/>}>
                    <SwitchesPanelItem
                        onChange={() => this.switchOptionA()}
                        title={<Translate content="option.setA"/>}
                        fullDescription={<Translate content="option.setAHint"/>}
                        switchProps={{
                            checked: this.state.optionA,
                        }}
                    />
                    <SwitchesPanelItem
                        onChange={() => this.switchOptionB()}
                        title={<Translate content="option.setB"/>}
                        fullDescription={<Translate content="option.setBHint"/>}
                        switchProps={{
                            checked: this.state.optionB,
                            loading: this.state.isSwitchOptionBProcessing,
                        }}
                    />
                    <SwitchesPanelItem
                        onChange={() => this.switchOptionC()}
                        title={<Translate content="option.setC"/>}
                        fullDescription={<Translate content="option.setCHint"/>}
                        switchProps={{
                            checked: this.state.optionC,
                        }}
                    />
                    <SwitchesPanelItem
                        onChange={() => this.switchOptionD()}
                        title={<Translate content="option.setD"/>}
                        fullDescription={<Translate content="option.setDHint"/>}
                        switchProps={{
                            checked: this.state.optionD,
                        }}
                    />
                </SwitchesPanel>
                <SwitchesPanel title={<Translate content="section.entities"/>}>
                    <SwitchesPanelItem
                        onChange={() => this.switchOptionE()}
                        title={<Translate content="option.setE"/>}
                        fullDescription={<Translate content="option.setEHint"/>}
                        switchProps={{
                            checked: this.state.optionE,
                        }}
                    >
                        <a
                            onClick={() => this.setState({ isDrawerEOpen: true })}
                        ><Translate content="option.setEEntities"/></a>
                    </SwitchesPanelItem>
                    <SwitchesPanelItem
                        onChange={() => this.switchOptionF()}
                        title={<Translate content="option.setF"/>}
                        fullDescription={<Translate content="option.setFHint"/>}
                        switchProps={{
                            checked: this.state.optionF,
                        }}
                    >
                        <a
                            onClick={() => this.setState({ isDrawerFOpen: true })}
                        ><Translate content="option.setFEntities"/></a>
                    </SwitchesPanelItem>
                </SwitchesPanel>
                <Drawer
                    title={<Translate content="entity.optionE.title"/>}
                    isOpen={this.state.isDrawerEOpen}
                    onClose={() => this.setState({ isDrawerEOpen: false })}
                >
                    <Toolbar>
                        <ToolbarGroup title="Actions">
                            <Button onToggle={() => this.turnOnEntityOptionE()}><Translate content="entity.optionE.action.turnOn"/></Button>
                            <Button onToggle={() => this.turnOffEntityOptionE()}><Translate content="entity.optionE.action.turnOff"/></Button>
                        </ToolbarGroup>
                        <ToolbarExpander/>
                        <ToolbarGroup title="General">
                            <Switch
                                onChange={() => this.switchOptionE()}
                                checked={this.state.optionE}
                            ><Translate content="option.setE"/></Switch>
                        </ToolbarGroup>
                    </Toolbar>
                    <List
                        columns={listColumnsE}
                        data={listDataE}
                        selection={this.state.selectionE}
                        onSelectionChange={selectionE => this.setState({ selectionE: selectionE })}
                    />
                </Drawer>
                <Drawer
                    title={<Translate content="entity.optionF.title"/>}
                    isOpen={this.state.isDrawerFOpen}
                    onClose={() => this.setState({ isDrawerFOpen: false })}
                >
                    <Toolbar>
                        <ToolbarGroup title="Actions">
                            <Button onToggle={() => this.turnOnEntityOptionF()}><Translate content="entity.optionF.action.turnOn"/></Button>
                            <Button onToggle={() => this.turnOffEntityOptionF()}><Translate content="entity.optionF.action.turnOff"/></Button>
                        </ToolbarGroup>
                        <ToolbarExpander/>
                        <ToolbarGroup title="General">
                            <Switch
                                onChange={() => this.switchOptionF()}
                                checked={this.state.optionF}
                            ><Translate content="option.setF"/></Switch>
                        </ToolbarGroup>
                    </Toolbar>
                    <List
                        columns={listColumnsF}
                        data={listDataF}
                        selection={this.state.selectionF}
                        onSelectionChange={selectionF => this.setState({ selectionF: selectionF })}
                    />
                </Drawer>
            </div>
        )
    }
}
