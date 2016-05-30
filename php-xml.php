<?php
/**
 * Created by wangrun03(wagnrun03@baidu.com).
 * Date: 16/5/30
 * Time: 下午2:45
 */


//php操作xml类
class XmlHandler{
    public $dom;

    /**
     * XmlHandler constructor.
     * 构造函数,处理xml文件类
     */
    function __construct()
    {
        $this->dom = new DOMDocument();
    }

    function loadOrCreateDocument($path='')
    {
        if(!file_exists($path)){
            header('Content-Type:text/plain');
            $root = $this->dom->createElement("class");
            $this->dom->appendChild($root);
            $this->dom->save("xml_test.xml");
        }else{
            $this->dom->load("xml_test.xml");
        }
        print $this->dom->saveXML();

    }

    /**
     * 添加元素
     */
    function addElement(){
        $root_class = $this->dom->documentElement;         //获取根节点
        for($i=0;$i<5;$i++){
            //$root_class_node = $root_class->item($i);
            $stu_node = $this->dom->createElement("student");
            $stu_node->setAttribute("xingbie", "man");
            $stu_node_name = $this->dom->createElement("name","name".$i);
            //set attrbuite
            $stu_node_name->setAttribute("hel","23");
            $stu_node_age = $this->dom->createElement("age","21");
            $stu_node_introduce = $this->dom->createElement("introduce", "111");
            $stu_node->appendChild($stu_node_name);
            $stu_node->appendChild($stu_node_age);
            $stu_node->appendChild($stu_node_introduce);
            $root_class->appendChild($stu_node);
        }
        $this->dom->save("xml_test.xml");
        print $this->dom->saveXML();
    }

    /**
     * 遍历节点
     */
    function traversalElement(){
        $stu_nodes = $this->dom->getElementsByTagName("student");
        echo $stu_nodes->length;
        echo '<br/>';
        for($i=0;$i<$stu_nodes->length;$i++) {
            $stu_node = $stu_nodes->item($i);
            for ($j = 0; $j < $stu_node->childNodes->length; $j++) {
                echo $stu_node->childNodes->item($j)->nodeValue;
                echo "<br/>";
            }
        }
    }

    /**
     * 删除节点
     */
    function  delElement(){
        $stu_nodes = $this->dom->getElementsByTagName("student");
        echo $stu_nodes->length;
        $stu_node = $stu_nodes->item($stu_nodes->length-1);
        $stu_node->parentNode->removeChild($stu_node);
        $this->dom->save("xml_test.xml");
        print $this->dom->saveXML();
    }

    /**
     * 修改属性
     */
    function updateAttr(){
        $stu_node = $this->dom->getElementsByTagName("age")->item(0);
        $stu_node->nodeValue = 100;
        $this->dom->save("xml_test.xml");
        print $this->dom->saveXML();
    }

    function __destruct()
    {
    }
}

$newXmlObject = new XmlHandler();
$newXmlObject->loadOrCreateDocument();
$newXmlObject->addElement();
$newXmlObject->traversalElement();
$newXmlObject->delElement();
$newXmlObject->updateAttr();



/*DOMDocument 属性：
Attributes存储节点的属性列表(只读)
childNodes存储节点的子节点列表(只读)

dataType返回此节点的数据类型

Definition以DTD或XML模式给出的节点的定义(只读)

Doctype 指定文档类型节点(只读)

documentElement返回文档的根元素(可读写)

firstChild返回当前节点的第一个子节点(只读)

Implementation返回XMLDOMImplementation对象

lastChild返回当前节点最后一个子节点(只读)

nextSibling返回当前节点的下一个兄弟节点(只读)

nodeName返回节点的名字(只读)

nodeType返回节点的类型(只读)

nodeTypedValue存储节点值(可读写)

nodeValue返回节点的文本(可读写)

ownerDocument返回包含此节点的根文档(只读)

parentNode返回父节点(只读)

Parsed 返回此节点及其子节点是否已经被解析(只读)

Prefix 返回名称空间前缀(只读)

preserveWhiteSpace指定是否保留空白(可读写)

previousSibling返回此节点的前一个兄弟节点(只读)

Text 返回此节点及其后代的文本内容(可读写)

url 返回最近载入的XML文档的URL(只读)

Xml 返回节点及其后代的XML表示(只读)



DOMDocument 方法：

appendChild为当前节点添加一个新的子节点,放在最后的子节点后

cloneNode返回当前节点的拷贝

createAttribute创建新的属性

createCDATASection创建包括给定数据的CDATA段

createComment创建一个注释节点

createDocumentFragment创建DocumentFragment对象

createElement_x创建一个元素节点

createEntityReference创建EntityReference对象

createNode创建给定类型,名字和命名空间的节点

createPorcessingInstruction创建操作指令节点

createTextNode创建包括给定数据的文本节点

getElementsByTagName返回指定名字的元素集合

hasChildNodes返回当前节点是否有子节点

insertBefore在指定节点前插入子节点

Load 导入指定位置的XML文档

loadXML 导入指定字符串的XML文档

removeChild从子结点列表中删除指定的子节点

replaceChild从子节点列表中替换指定的子节点

Save 把XML文件存到指定节点

selectNodes对节点进行指定的匹配,并返回匹配节点列表

selectSingleNode对节点进行指定的匹配,并返回第一个匹配节点

transformNode使用指定的样式表对节点及其后代进行转换*/
















