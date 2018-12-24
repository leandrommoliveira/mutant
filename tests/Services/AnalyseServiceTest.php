<?php

use App\Mutant\MutantInterface;
use App\Repository\DnaRepository;
use App\Services\AnalyseService;
use App\Validator\DnaValidator;

class AnalyseServiceTest extends TestCase
{
    private $mutantFalse = [
        "ATGCGA","CAGTGC","TTATTT","AGACGG","GCGTCA","TCACTG"
    ];

    private $mutantTrue = [
        "ATGCGA","CAGTGC","TTATGT","AGAAGG","CCCCTA","TCACTG"
    ];

    public function getMutantAnalyseMock()
    {
        return $this->getMockBuilder(MutantInterface::class)
                    ->disableOriginalConstructor()
                    ->setMethods(['isMutant'])
                    ->getMock();
    }

    public function getDnaValidatorMock()
    {
        return $this->getMockBuilder(DnaValidator::class)
                    ->disableOriginalConstructor()
                    ->setMethods(['validate'])
                    ->getMock();
    }

    public function getRepositoryMock()
    {
        return $this->getMockBuilder(DnaRepository::class)
                    ->disableOriginalConstructor()
                    ->setMethods(['find', 'insert'])
                    ->getMock();
    }

    public function testIsMutantReturnValidatorFalse()
    {
        $validator = $this->getDnaValidatorMock();
        $validator->expects($this->once())
                  ->method('validate')
                  ->willReturn(false);

        $service = new AnalyseService(
            $this->getMutantAnalyseMock(),
            $validator,
            $this->getRepositoryMock()
        );

        $result = $service->isMutant($this->mutantFalse);

        $this->assertEquals(false, $result);
    }

    public function testIsMutantFindReturnHuman()
    {
        $validator = $this->getDnaValidatorMock();
        $validator->expects($this->once())
                  ->method('validate')
                  ->willReturn(true);

        $mutant = new \stdClass;
        $mutant->mutant = 0;
        $repository = $this->getRepositoryMock();
        $repository->expects($this->once())
                   ->method('find')
                   ->willReturn($mutant);

        $service = new AnalyseService(
            $this->getMutantAnalyseMock(),
            $validator,
            $repository
        );

        $result = $service->isMutant($this->mutantFalse);

        $this->assertEquals(false, $result);
    }

    public function testIsMutantFindReturnMutant()
    {
        $validator = $this->getDnaValidatorMock();
        $validator->expects($this->once())
                  ->method('validate')
                  ->willReturn(true);

        $mutant = new \stdClass;
        $mutant->mutant = 1;
        $repository = $this->getRepositoryMock();
        $repository->expects($this->once())
                   ->method('find')
                   ->willReturn($mutant);

        $service = new AnalyseService(
            $this->getMutantAnalyseMock(),
            $validator,
            $repository
        );

        $result = $service->isMutant($this->mutantTrue);

        $this->assertEquals(true, $result);
    }

    public function testIsMutantIsMutantReturnTrue()
    {
        $validator = $this->getDnaValidatorMock();
        $validator->expects($this->once())
                  ->method('validate')
                  ->willReturn(true);

        $repository = $this->getRepositoryMock();
        $repository->expects($this->once())
                   ->method('find')
                   ->willReturn(null);

        $repository->expects($this->once())
                   ->method('insert');

        $analyseMock = $this->getMutantAnalyseMock();
        $analyseMock->expects($this->once())
                    ->method('isMutant')
                    ->willReturn(true);

        $service = new AnalyseService(
            $analyseMock,
            $validator,
            $repository
        );

        $result = $service->isMutant($this->mutantTrue);

        $this->assertEquals(true, $result);
    }

    public function testIsMutantIsMutantReturnFalse()
    {
        $validator = $this->getDnaValidatorMock();
        $validator->expects($this->once())
                  ->method('validate')
                  ->willReturn(true);

        $repository = $this->getRepositoryMock();
        $repository->expects($this->once())
                   ->method('find')
                   ->willReturn(null);

        $repository->expects($this->once())
                   ->method('insert');

        $analyseMock = $this->getMutantAnalyseMock();
        $analyseMock->expects($this->once())
                    ->method('isMutant')
                    ->willReturn(false);

        $service = new AnalyseService(
            $analyseMock,
            $validator,
            $repository
        );

        $result = $service->isMutant($this->mutantFalse);

        $this->assertEquals(false, $result);
    }
}
