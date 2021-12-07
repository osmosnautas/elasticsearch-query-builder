<?php

namespace Erichard\ElasticQueryBuilder\Aggregation;

class MultiTermsAggregation extends Aggregation
{
    /** @var  */
    private $aggregation;

    /** @var  */
    private $field;

    /** @var  */
    private $terms = [];

    /** @var  */
    private $size;

    public function setAggregation(Aggregation $aggregation)
    {
        $this->aggregation = $aggregation;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param mixed $field
     * @return MultiTermsAggregation
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
    public function getTerms(): array
    {
        return $this->terms;
    }

    /**
     * @param mixed $terms
     * @return MultiTermsAggregation
     */
    public function setTerms(array $terms): MultiTermsAggregation
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
     * @return MultiTermsAggregation
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

        $multiterm['multi_terms'] = [
            'terms' => $this->terms,
            'size' => $this->size
        ];

        if (!is_null($this->aggregation)) {
            $multiterm['aggs'] = [
                $this->aggregation->getName() => $this->aggregation->build()
            ];
        }

        return $multiterm;
    }
}
