<?php

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Aggregation\Aggregation;

class MultiTermQuery extends Aggregation
{
    /** @var  */
    private $field;

    /** @var  */
    private $terms = [];

    /** @var  */
    private $size;

    /**
     * @return mixed
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param mixed $field
     * @return MultiTermQuery
     */
    public function setField($field)
    {
        $this->field = $field;
        array_push($this->terms, ['field' => $field]);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTerms()
    {
        return $this->terms;
    }

    /**
     * @param mixed $terms
     * @return MultiTermQuery
     */
    public function setTerms($terms)
    {
        $this->terms = $terms;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     * @return MultiTermQuery
     */
    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return array
     */
    public function build(): array
    {
        $term = [
            'field' => $this->field
        ];

        return [
            'multi_terms' => [
                'terms' => $this->terms,
                'size' => $this->size
            ]
        ];
    }
}
