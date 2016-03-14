<?php

namespace PhpCollectionJson;

class Collection extends CollectionJsonObject
{
    /**
     * Collection constructor.
     * @param $href
     */
    public function __construct($href)
    {
        parent::__construct(
            'version',
            'href',
            'links',
            'items',
            'queries',
            'template',
            'error',
            'paging'
        );
        $this->version = '1.0';
        $this->href = $href;
        $this->data['items'] = array();
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->verifyProperty($name);

        switch ($name) {
            case 'version':
                $this->data[$name] = $value;
                break;
            case 'href':
                $this->data[$name] = $value;
                break;
            default:
                break;
        }
    }

    /**
     * @param Link $link
     * @return $this
     * @throws DuplicateObjectException
     */
    public function addLink(Link $link)
    {
        if (!array_key_exists('links', $this->data)) {
            $this->data['links'] = array();
        }

        if (!in_array($link, $this->data['links'])) {
            $this->data['links'][] = $link;
        } else {
            throw new DuplicateObjectException('Attempted to add duplicate Link to Collection');
        }

        return $this;
    }

    /**
     * @param Link $link
     * @return bool
     */
    public function removeLink(Link $link)
    {
        if (!array_key_exists('links', $this->data)) {
            return false;
        }

        $found = false;

        for ($i = 0; $i < count($this->data['links']); ++$i) {

            if ($link == $this->data['links'][$i]) {
                unset($this->data['links'][$i]);
                $this->data['links'] = array_values($this->data['links']);
                $found = true;
            }
        }

        if (!count($this->data['links'])) {
            unset($this->data['links']);
        }

        return $found;
    }

    /**
     * @param Item $item
     * @return $this
     * @throws DuplicateObjectException
     */
    public function addItem(Item $item)
    {
        if (!array_key_exists('items', $this->data)) {
            $this->data['items'] = array();
        }

        if (!in_array($item, $this->data['items'])) {
            $this->data['items'][] = $item;
        } else {
            throw new DuplicateObjectException('Attempted to add duplicate Item to Collection');
        }

        return $this;
    }

    /**
     * @param Item $item
     * @return bool
     */
    public function removeItem(Item $item)
    {
        if (!array_key_exists('items', $this->data)) {
            return false;
        }

        $found = true;

        for ($i = 0; $i < count($this->data['items']); ++$i) {

            if ($item == $this->data['items'][$i]) {
                unset($this->data['items'][$i]);
                $this->data['items'] = array_values($this->data['items']);
                $found = true;
            }
        }

        if (!count($this->data['items'])) {
            unset($this->data['items']);
        }

        return $found;
    }

    /**
     * @param Error $error
     */
    public function setError(Error $error)
    {
        $this->data['error'] = $error;
    }

    public function unsetError()
    {
        unset($this->data['error']);
    }

    /**
     * @param Template $template
     */
    public function setTemplate(Template $template)
    {
        $this->data['template'] = $template;
    }

    public function unsetTemplate()
    {
        unset($this->data['template']);
    }

    /**
     * @param Query $query
     * @return $this
     * @throws DuplicateObjectException
     */
    public function addQuery(Query $query)
    {
        if (!array_key_exists('queries', $this->data)) {
            $this->data['queries'] = array();
        }

        if (!in_array($query, $this->data['queries'])) {
            $this->data['queries'][] = $query;
        } else {
            throw new DuplicateObjectException('Attempted to add duplicate Query to Document');
        }

        return $this;
    }

    /**
     * @param Query $query
     * @return bool
     */
    public function removeQuery(Query $query)
    {
        if (!array_key_exists('queries', $this->data)) {
            return false;
        }

        $found = false;

        for ($i = 0; $i < count($this->data['queries']); ++$i) {

            if ($query == $this->data['queries'][$i]) {
                unset($this->data['queries'][$i]);
                $this->data['queries'] = array_values($this->data['queries']);
                $found = true;
            }
        }

        if (!count($this->data['queries'])) {
            unset($this->data['queries']);
        }

        return $found;
    }

    /**
     * @param Paging $paging
     */
    public function setPaging(Paging $paging)
    {
        $this->data['paging'] = $paging;
    }

    public function unsetPaging()
    {
        unset($this->data['paging']);
    }
}
