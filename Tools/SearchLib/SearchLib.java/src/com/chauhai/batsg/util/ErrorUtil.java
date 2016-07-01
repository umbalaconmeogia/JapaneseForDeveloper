package com.chauhai.batsg.util;


/**
 * Utility functions on error.
 *
 * @author umbalaconmeogia
 *
 */
public class ErrorUtil {

  /**
   * Wrap an exception by RuntimeException.
   * <p>
   * The exception is not wrapped if it has already been a RuntimeException.
   * @param e The exception to be wrapped.
   * @return A RuntimeException object.
   */
  public static RuntimeException runtimeException(Exception e) {
    return e instanceof RuntimeException ?
        (RuntimeException) e :
        new RuntimeException("Exception wrapped by RuntimeException", e);
  }

  /**
   * Wrap an exception by RuntimeException then throw it.
   * <p>
   * The exception is not wrapped if it has already been a RuntimeException.
   * @param e The exception to be wrapped.
   * @return A RuntimeException object.
   */
  public static void throwRuntimeException(Exception e) {
    throw runtimeException(e);
  }
}