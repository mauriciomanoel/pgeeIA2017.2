

public class ActivationFunction {
	
	// Calculating function sigmoid - https://stackoverflow.com/questions/2887815/speeding-up-math-calculations-in-java
	public static float sigmoid(float x) {
		return (float) (1 / (1+Math.exp(-x)));
	}

	// Calculating function derivative of sigmoid - https://math.stackexchange.com/questions/78575/derivative-of-sigmoid-function-sigma-x-frac11e-x
	public static float dSigmoid(float x) {
		return x*(1-x);
	}
}
