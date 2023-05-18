const { parseJSON } = require("jquery");

//Classe TreeView
function treeView() {
    this.nodeRoot = null;//Tipo itemNode.
}

//Adiciona um n� raiz.
treeView.prototype.addNodeRoot = function (id, name, image, isExpand, link) {
    this.nodeRoot = new itemNode(id, name, image, isExpand, link);

    return this.nodeRoot;
};

//Limpa o n� raiz.
treeView.prototype.clear = function () {
    this.nodeRoot = null;
};

//Retorna o conte�do html para criar o treeview.
treeView.prototype.contentHtml = function () {
    return this.nodeRoot.contentHtml(this.nodeRoot.id, 0, true, false, false, this.nodeRoot.isExpand, true);
};        

//classe N�.
function itemNode(id, name, image, isExpand, link) {
    this.id = id;//Identificador do n�
    this.name = name; //Texto do n�.
    this.image = image;//Imagem do n�
    this.isExpand = isExpand;//Indica se o n� � mostrado expandido no momento da cria��o.
    this.link = link;//Indica se o n� vai ser um link.
    this.items = [];//Cole��o de n�s filhos.
}

//Adiciona um n� filho
itemNode.prototype.addNode = function (id, name, image, isExpand, link) {
    var obj = new itemNode(id, name, image, isExpand, link);

    this.items[this.items.length] = obj;

    return obj;
};

//Limpa a cole��o de n�s filhos.
itemNode.prototype.clear = function () {
    this.items = [];
};

//Obt�m identificadores dos n�s filhos. Utilizado para expandir e recolher os n�s filhos.
itemNode.prototype.getIdChildNodes = function () {
    var arrayId = '';

    for (var i = 0; i < this.items.length; i++) {
        arrayId += this.items[i].id + ';';
    }

    return arrayId;
}

//Retorna o conte�do html para criar o treeview.
//<param name="id">Identificador do objeto n�.</param>
//<param name="indent">Identa��o dos n�s.</param>
//<param name="nodeFirst">Indica se o n� � o n� raiz.</param>
//<param name="nodeSingle">Indica se o n� n�o tem irm�os.</param>
//<param name="isImgLine">Indica se imagem linha ser� adicionada. � adiciona quando o pai do n� tem irm�o.</param>
//<param name="isExpand">Indica se o n� vai estar expandido no momento da cria��o.</param>
//<param name="parentNodeSingle">Indica se o pai do n� n�o tem irm�os. Isso indica para a fun�o adicionar ou n�o a imagem linha</param>
itemNode.prototype.contentHtml = function (id, indent, nodeFirst, nodeSingle, isImgLine, isExpand, parentNodeSingle) {
    var content = '';
    var strIndent = '';

    for (var i = 0; i < indent; i++) {
        strIndent += '&nbsp;&nbsp;&nbsp;';
    }

    var className = '';
    var lineImg = '';
    var addImgLine = false;

    if (!nodeFirst && !nodeSingle) {
        addImgLine = true;
    }

    if (nodeFirst) {
        if (!isExpand) {
            className = 'nolines_PlusTree';
        }
        else {
            className = 'nolines_MinusTree';
        }

        nodeFirst = false;
    }
    else {
        if (nodeSingle) {
            if (this.items.length == 0) {
                className = 'joinBottomTree';
            }
            else {
                if (!isExpand) {
                    className = 'plusBottomTree';
                }
                else {
                    className = 'minusBottomTree';
                }
            }
        }
        else {
            if (this.items.length == 0) {
                className = 'joinTree';
            }
            else {
                if (!isExpand) {
                    className = 'plusTree';
                }
                else {
                    className = 'minusTree';
                }
            }
        }
    }

    var eventClick = '';

    if (this.items.length > 0) {
        var arrayId = this.getIdChildNodes();

        eventClick = 'onclick="nodeExpand(document.getElementById(\'' + id + '\'), \'' + arrayId + '\')"';
    }

    content += '<div id="' + id + '" style="display:@visible@;"><input id="' + id + 'Hidden" type="hidden" value="' + (isExpand ? '1' : '0') + '" />';

    var valueNode = '';
    var valueLink = '';

    if (this.link != null && this.link != '') {
        valueLink = '<a class="fontTree" href="' + this.link + '">' + this.name + '</a>';
    }
    else {
        valueLink = this.name;
    }
    
    if (this.image != null && this.image != '') {
        valueNode = '<label class="fontTree" style="background: url(' + this.image + ') no-repeat left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + valueLink + '</label>';
    }
    else {
        valueNode = '<label class="fontTree">' + valueLink + '</label>';
    }

    if (isImgLine) {
        var strIndentLine = '';

        for (var i = 0; i < indent - 1; i++) {
            if (i == indent - 2 && parentNodeSingle) {
                strIndentLine += '&nbsp;&nbsp;&nbsp;<label>&nbsp;&nbsp;</label>';
            }
            else {
                strIndentLine += '&nbsp;&nbsp;&nbsp;<label class="lineTree">&nbsp;&nbsp;</label>';
            }
        }

        content += strIndentLine + '&nbsp;&nbsp;&nbsp;<label id="' + id + 'ClassNameHidden" class="' + className + '" ' + eventClick + '>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>' + valueNode + '<br>';

        addImgLine = true;
    }
    else {
        content += strIndent + '<label id="' + id + 'ClassNameHidden" class="' + className + '" ' + eventClick + '>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>' + valueNode + '<br>';
    }

    var newindent = indent + 1;

    for (var i = 0; i < this.items.length; i++) {
        var isNodeSingle = false;
        var strValue = '';

        if (i == this.items.length - 1) {
            isNodeSingle = true;
        }

        strValue = this.items[i].contentHtml(this.items[i].id, newindent, nodeFirst, isNodeSingle, addImgLine, (!isExpand ? false : this.items[i].isExpand), nodeSingle);

        if (isExpand) {
            strValue = strValue.replace('@visible@', 'block');
        }
        else {
            strValue = strValue.replace('@visible@', 'none');
        }

        content += strValue;
    }

    content += '</div>';

    return content;
};

//Expandi ou recolhe os filhos do n�.
//<param name="objDiv">Div que o n� e os n�s filhos est�o dentro.</param>
//<param name="ids">Todos os identificadores dos n�s filhos, utilizamos para expandir ou recolher eles.</param>
function nodeExpand(objDiv, ids) {
    var arrayId = ids.split(';');
    var display = '';

    var objHidden = document.getElementById(objDiv.id + 'Hidden');

    var objLabel = document.getElementById(objDiv.id + 'ClassNameHidden');

    if (objLabel.className == 'nolines_PlusTree' || objLabel.className == 'nolines_MinusTree') {
        if (objLabel.className == 'nolines_PlusTree') {
            objLabel.className = 'nolines_MinusTree';
        }
        else {
            objLabel.className = 'nolines_PlusTree';
        }
    }
    else if (objLabel.className == 'plusBottomTree' || objLabel.className == 'minusBottomTree') {
        if (objLabel.className == 'plusBottomTree') {
            objLabel.className = 'minusBottomTree';
        }
        else {
            objLabel.className = 'plusBottomTree';
        }
    }
    else if (objLabel.className == 'plusTree' || objLabel.className == 'minusTree') {
        if (objLabel.className == 'plusTree') {
            objLabel.className = 'minusTree';
        }
        else {
            objLabel.className = 'plusTree';
        }
    }

    if (objHidden.value == '0') {
        display = 'block';
        objHidden.value = '1';
    }
    else {
        display = 'none';
        objHidden.value = '0';
    }

    for (var i = 0; i < arrayId.length - 1; i++) {
        var objNode = document.getElementById(arrayId[i]);

        objNode.style.display = display;
    }
}

