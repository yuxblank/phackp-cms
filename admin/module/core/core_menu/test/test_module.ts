import {Component, NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';

@Component({
  selector: 'test',
  template: `Test`,
})
export class Test {
}

@NgModule({
  imports: [CommonModule],
  declarations: [Test]
})
export class TestModule {}
